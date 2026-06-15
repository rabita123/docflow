<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Anthropic\Laravel\Facades\Anthropic;

class RedactController extends BasePdfController
{
    protected string $model = 'claude-sonnet-4-20250514';

    /**
     * Redact sensitive information from a PDF.
     *
     * Steps:
     *  1. Extract text + bounding boxes using pdftohtml -xml
     *  2. Send text to Claude AI → get list of sensitive strings to redact
     *  3. For each page, convert to image (ImageMagick)
     *  4. Draw black rectangles over matched text regions
     *  5. Reassemble pages into a PDF
     *  6. Return download
     */
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $pdfPath    = $this->saveUpload($request->file('file'));
        $categories = $request->input('categories', ['email', 'phone', 'ssn', 'creditcard', 'address']);
        $customTerms = trim($request->input('custom_terms', ''));

        if (is_string($categories)) {
            $categories = explode(',', $categories);
        }

        // ── Step 1: Extract text + bounding boxes via pdftohtml ───────────
        $xmlBase = $this->outputDir . '/' . Str::random(10);
        $xmlFile = $xmlBase . '.xml';

        $this->run('pdftohtml -xml -q ' . escapeshellarg($pdfPath) . ' ' . escapeshellarg($xmlBase) . ' 2>/dev/null');

        // pdftohtml appends _html_s.xml or similar — find it
        $possibleXml = glob($xmlBase . '*.xml');
        if (empty($possibleXml) && file_exists($xmlFile)) {
            // fine
        } elseif (!empty($possibleXml)) {
            $xmlFile = $possibleXml[0];
        }

        if (!file_exists($xmlFile)) {
            @unlink($pdfPath);
            return $this->err('Could not parse PDF structure. Make sure it is a valid text-based PDF.');
        }

        // ── Step 2: Parse XML, extract all text ───────────────────────────
        $parsedPages = $this->parseXml($xmlFile);
        @unlink($xmlFile);

        // Clean up any extra pdftohtml output files
        foreach (glob($xmlBase . '*') as $f) @unlink($f);

        if (empty($parsedPages)) {
            @unlink($pdfPath);
            return $this->err('No text found in PDF. Try OCR first for scanned documents.');
        }

        $allText = '';
        foreach ($parsedPages as $page) {
            foreach ($page['words'] as $word) {
                $allText .= $word['text'] . ' ';
            }
            $allText .= "\n";
        }

        // ── Step 3: Claude identifies sensitive strings ────────────────────
        $sensitiveStrings = $this->findSensitiveStrings($allText, $categories, $customTerms);

        if (empty($sensitiveStrings)) {
            @unlink($pdfPath);
            return $this->err('No sensitive information found to redact. Try adding custom terms.');
        }

        // ── Step 4: Per-page — render image, draw black boxes, save ───────
        $DPI        = 150;
        $scale      = $DPI / 96; // pdftohtml uses 96 DPI by default
        $pageImages = [];
        $tmpFiles   = [];

        foreach ($parsedPages as $pageNum => $page) {
            $imgPath    = $this->outputDir . '/' . Str::random(10) . '_pg' . $pageNum . '.png';
            $tmpFiles[] = $imgPath;

            // Render page to image
            $this->run(
                $this->magick()
                . ' -density ' . $DPI
                . ' ' . escapeshellarg($pdfPath . '[' . ($pageNum - 1) . ']')
                . ' -background white -alpha remove'
                . ' ' . escapeshellarg($imgPath)
            );

            if (!file_exists($imgPath)) continue;

            // Find matching words and collect rectangles
            $draws = [];
            foreach ($page['words'] as $word) {
                $text = $word['text'];
                foreach ($sensitiveStrings as $sensitive) {
                    if (strlen($sensitive) < 3) continue;
                    if (stripos($text, $sensitive) !== false || stripos($sensitive, $text) !== false) {
                        // Scale coordinates
                        $x1 = max(0, (int)($word['left']   * $scale) - 2);
                        $y1 = max(0, (int)($word['top']    * $scale) - 2);
                        $x2 = (int)(($word['left'] + $word['width'])  * $scale) + 2;
                        $y2 = (int)(($word['top']  + $word['height']) * $scale) + 2;
                        $draws[] = "rectangle {$x1},{$y1} {$x2},{$y2}";
                        break;
                    }
                }
            }

            if (!empty($draws)) {
                $drawArgs = implode(' -draw ', array_map(fn($d) => escapeshellarg($d), $draws));
                $this->run(
                    $this->magick() . ' ' . escapeshellarg($imgPath)
                    . ' -fill black -draw ' . $drawArgs
                    . ' ' . escapeshellarg($imgPath)
                );
            }

            $pageImages[] = $imgPath;
        }

        // ── Step 5: Merge page images back into PDF ────────────────────────
        $outputPdf = $this->outputPath('pdf');
        @unlink($pdfPath);

        if (empty($pageImages)) {
            return $this->err('Could not render PDF pages.');
        }

        $imgArgs = implode(' ', array_map('escapeshellarg', $pageImages));
        $this->run($this->magick() . ' ' . $imgArgs . ' -compress jpeg -quality 90 ' . escapeshellarg($outputPdf));

        foreach ($tmpFiles as $f) @unlink($f);

        if (!file_exists($outputPdf) || filesize($outputPdf) === 0) {
            return $this->err('Failed to generate redacted PDF.');
        }

        return $this->download($outputPdf, 'redacted.pdf');
    }

    /**
     * Parse pdftohtml XML output into per-page word lists with bounding boxes.
     */
    private function parseXml(string $xmlFile): array
    {
        $pages = [];

        libxml_use_internal_errors(true);
        $xml = simplexml_load_file($xmlFile);
        if (!$xml) return [];

        foreach ($xml->page as $page) {
            $pageNum = (int)($page['number'] ?? count($pages) + 1);
            $pageH   = (float)($page['height'] ?? 800);
            $words   = [];

            foreach ($page->text as $text) {
                $str = trim((string)$text);
                if ($str === '') continue;

                $words[] = [
                    'text'   => $str,
                    'top'    => (float)($text['top']    ?? 0),
                    'left'   => (float)($text['left']   ?? 0),
                    'width'  => (float)($text['width']  ?? strlen($str) * 6),
                    'height' => (float)($text['height'] ?? 12),
                ];
            }

            if (!empty($words)) {
                $pages[$pageNum] = ['words' => $words, 'height' => $pageH];
            }
        }

        return $pages;
    }

    /**
     * Ask Claude to identify sensitive strings in the text.
     * Returns a flat array of strings to redact.
     */
    private function findSensitiveStrings(string $text, array $categories, string $customTerms): array
    {
        $catDescriptions = [];
        $catMap = [
            'email'      => 'email addresses (e.g. user@example.com)',
            'phone'      => 'phone numbers in any format',
            'ssn'        => 'SSN, national ID, passport numbers, NID numbers',
            'creditcard' => 'credit card, debit card numbers',
            'address'    => 'physical addresses, street names, postal codes',
            'name'       => 'full person names',
            'dob'        => 'dates of birth',
            'bankaccount'=> 'bank account or routing numbers',
        ];

        foreach ($categories as $cat) {
            if (isset($catMap[$cat])) $catDescriptions[] = $catMap[$cat];
        }

        if ($customTerms) {
            $catDescriptions[] = 'these specific terms: ' . $customTerms;
        }

        if (empty($catDescriptions)) return [];

        $categoryList = implode(', ', $catDescriptions);

        $prompt = <<<PROMPT
You are a document redaction assistant. Extract ALL instances of the following from the text:
{$categoryList}

Return ONLY a JSON array of the exact strings to redact. Nothing else. No explanation.
Example: ["john@email.com", "555-1234", "123 Main St"]

If nothing found, return: []

TEXT:
{$text}
PROMPT;

        try {
            $response = Anthropic::messages()->create([
                'model'      => $this->model,
                'max_tokens' => 1000,
                'messages'   => [['role' => 'user', 'content' => $prompt]],
            ]);

            $raw   = $response->content[0]->text ?? '[]';
            $clean = preg_replace('/^```(json)?\s*/m', '', $raw);
            $clean = preg_replace('/\s*```$/m', '', $clean);
            $arr   = json_decode(trim($clean), true);

            return is_array($arr) ? array_filter($arr, fn($s) => is_string($s) && strlen($s) >= 2) : [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
