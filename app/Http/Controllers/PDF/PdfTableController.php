<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Anthropic\Laravel\Facades\Anthropic;

class PdfTableController extends BasePdfController
{
    protected string $model = 'claude-haiku-4-5-20251001';

    /**
     * Extract tables from a PDF and return structured JSON.
     *
     * Steps:
     *  1. Extract layout-preserved text using pdftotext -layout
     *  2. If text too short, fall back to page-image + Claude vision
     *  3. Send text to Claude → structured JSON [{name, headers[], rows[][]}]
     *  4. Return JSON for frontend to render preview + generate CSV/Excel
     */
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $pdfPath = $this->saveUpload($request->file('file'));

        // ── Step 1: Extract layout-preserving text ────────────────────────────
        $text = $this->extractLayoutText($pdfPath);

        // ── Step 2: Vision fallback for scanned PDFs ──────────────────────────
        $usedVision = false;
        if (strlen(trim($text)) < 100) {
            $visionResult = $this->extractTablesViaVision($pdfPath);
            @unlink($pdfPath);
            if (is_array($visionResult)) {
                return response()->json([
                    'tables'    => $visionResult,
                    'method'    => 'vision',
                    'page_info' => 'Extracted via AI image recognition',
                ]);
            }
            return $this->err('No readable text found in this PDF. For scanned PDFs, run OCR first at /ocr-pdf to make the text layer readable.');
        }

        @unlink($pdfPath);

        // ── Step 3: Claude extracts tables ────────────────────────────────────
        $tables = $this->extractTablesFromText($text);

        if (empty($tables)) {
            return $this->err('No tables found in this PDF. Make sure the PDF contains structured table data.');
        }

        return response()->json([
            'tables'    => $tables,
            'method'    => 'text',
            'page_info' => 'Extracted from text layer',
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Extract layout-preserved text (keeps column alignment)
    // ─────────────────────────────────────────────────────────────────────────
    private function extractLayoutText(string $pdfPath): string
    {
        $txtPath = $this->outputPath('txt');

        // -layout preserves whitespace/columns; -nopgbrk removes page breaks
        $cmd = $this->getPdftotextCmd()
             . ' -layout -nopgbrk'
             . ' ' . escapeshellarg($pdfPath)
             . ' ' . escapeshellarg($txtPath);

        $this->run($cmd);

        if (!file_exists($txtPath)) return '';

        $text = file_get_contents($txtPath);
        @unlink($txtPath);

        // Limit to 30k chars — Claude context is ample but keep cost low
        return substr(trim($text), 0, 30000);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // For scanned PDFs: render first 3 pages as images → Claude vision
    // ─────────────────────────────────────────────────────────────────────────
    private function extractTablesViaVision(string $pdfPath): ?array
    {
        $pageCount = min($this->getPageCount($pdfPath), 5);
        $imageContents = [];
        $tmpFiles = [];

        for ($page = 1; $page <= $pageCount; $page++) {
            $imgPath    = $this->outputDir . '/' . Str::random(10) . '_p' . $page . '.png';
            $tmpFiles[] = $imgPath;

            $this->run(
                $this->magick()
                . ' -density 150'
                . ' ' . escapeshellarg($pdfPath . '[' . ($page - 1) . ']')
                . ' -background white -alpha remove'
                . ' ' . escapeshellarg($imgPath)
            );

            if (!file_exists($imgPath)) continue;

            $b64 = base64_encode(file_get_contents($imgPath));
            $imageContents[] = [
                'type'   => 'image',
                'source' => ['type' => 'base64', 'media_type' => 'image/png', 'data' => $b64],
            ];
            $imageContents[] = ['type' => 'text', 'text' => "Page {$page} above."];
        }

        foreach ($tmpFiles as $f) @unlink($f);

        if (empty($imageContents)) return null;

        $imageContents[] = [
            'type' => 'text',
            'text' => 'Extract ALL tables from these PDF page images. Return ONLY a JSON array. Each table object: {"name":"Table 1","headers":["Col1","Col2",...],"rows":[["val1","val2",...],...]}.  No explanation, no markdown — just raw JSON array. If no tables found, return [].',
        ];

        try {
            $response = Anthropic::messages()->create([
                'model'      => $this->model,
                'max_tokens' => 4000,
                'messages'   => [['role' => 'user', 'content' => $imageContents]],
            ]);

            $raw   = $response->content[0]->text ?? '[]';
            $clean = preg_replace('/^```(json)?\s*/m', '', $raw);
            $clean = preg_replace('/\s*```$/m', '', $clean);
            $arr   = json_decode(trim($clean), true);

            return is_array($arr) ? $arr : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Ask Claude to find and structure all tables in the extracted text
    // ─────────────────────────────────────────────────────────────────────────
    private function extractTablesFromText(string $text): array
    {
        $prompt = <<<PROMPT
You are a PDF table extraction expert. Find ALL tables in the following PDF text (extracted with layout preservation).

Return ONLY a JSON array of table objects. Each object:
{
  "name": "Table 1",       // descriptive name or title if visible, else "Table N"
  "headers": ["Col1", "Col2", "Col3"],  // header row
  "rows": [
    ["val1", "val2", "val3"],
    ["val4", "val5", "val6"]
  ]
}

Rules:
- Extract every table you find, even partial ones
- If a column has no header, use "Column N"
- Keep all cell values as strings
- Do NOT include explanations or markdown — output raw JSON array only
- If no tables found, return: []

PDF TEXT:
{$text}
PROMPT;

        try {
            $response = Anthropic::messages()->create([
                'model'      => $this->model,
                'max_tokens' => 4000,
                'messages'   => [['role' => 'user', 'content' => $prompt]],
            ]);

            $raw   = $response->content[0]->text ?? '[]';
            $clean = preg_replace('/^```(json)?\s*/m', '', $raw);
            $clean = preg_replace('/\s*```$/m', '', $clean);
            $arr   = json_decode(trim($clean), true);

            return is_array($arr) ? $arr : [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
