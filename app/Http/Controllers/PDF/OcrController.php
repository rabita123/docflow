<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OcrController extends BasePdfController
{
    /**
     * Run Tesseract OCR on a scanned PDF.
     * format = 'txt'  → plain text download
     * format = 'pdf'  → searchable PDF (Tesseract pdf output)
     * format = 'json' → JSON with text per page (used by frontend preview)
     */
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $pdfPath = $this->saveUpload($request->file('file'));
        $lang    = $this->tesseractLang($request->input('lang', 'eng'));
        $format  = in_array($request->input('format', 'txt'), ['txt', 'pdf', 'json'])
                   ? $request->input('format', 'txt')
                   : 'txt';

        // Check tesseract is available
        exec('which tesseract 2>/dev/null', $tOut, $tCode);
        if ($tCode !== 0) {
            @unlink($pdfPath);
            return $this->err('OCR is not available on this server. Please contact support.');
        }

        // Get page count (cap at 20 pages)
        $pageCount = min($this->getPageCount($pdfPath), 20);

        $textParts = [];
        $pdfParts  = [];
        $tmpFiles  = [];

        for ($page = 1; $page <= $pageCount; $page++) {
            // Convert single PDF page to PNG
            $imgPath    = $this->outputDir . '/' . Str::random(10) . '_p' . $page . '.png';
            $tmpFiles[] = $imgPath;

            $this->run(
                $this->magick()
                . ' -density 200'
                . ' ' . escapeshellarg($pdfPath . '[' . ($page - 1) . ']')
                . ' -colorspace Gray -quality 90'
                . ' ' . escapeshellarg($imgPath)
            );

            if (!file_exists($imgPath)) continue;

            $ocrBase    = $this->outputDir . '/' . Str::random(10) . '_ocr';

            if ($format === 'pdf') {
                // Tesseract PDF output
                $ocrPdf     = $ocrBase . '.pdf';
                $tmpFiles[] = $ocrPdf;
                $this->run('tesseract ' . escapeshellarg($imgPath) . ' ' . escapeshellarg($ocrBase) . ' -l ' . $lang . ' pdf 2>/dev/null');
                if (file_exists($ocrPdf)) $pdfParts[] = $ocrPdf;
            } else {
                // TXT output
                $ocrTxt     = $ocrBase . '.txt';
                $tmpFiles[] = $ocrTxt;
                $this->run('tesseract ' . escapeshellarg($imgPath) . ' ' . escapeshellarg($ocrBase) . ' -l ' . $lang . ' 2>/dev/null');
                if (file_exists($ocrTxt)) {
                    $pageText = trim(file_get_contents($ocrTxt));
                    if ($pageText) $textParts[] = "--- Page {$page} ---\n" . $pageText;
                }
            }
        }

        @unlink($pdfPath);

        // ── Searchable PDF ──────────────────────────────────────────────────
        if ($format === 'pdf') {
            foreach ($tmpFiles as $f) {
                if (!in_array($f, $pdfParts)) @unlink($f);
            }

            if (empty($pdfParts)) {
                return $this->err('Could not generate searchable PDF. Make sure the file is a scanned image-based PDF.');
            }

            if (count($pdfParts) === 1) {
                $finalPdf = $pdfParts[0];
            } else {
                // Merge all page PDFs with pdftk
                $finalPdf   = $this->outputPath('pdf');
                $mergeCmd   = $this->pdftk() . ' ' . implode(' ', array_map('escapeshellarg', $pdfParts)) . ' cat output ' . escapeshellarg($finalPdf);
                $this->run($mergeCmd);
                foreach ($pdfParts as $f) @unlink($f);
            }

            if (!file_exists($finalPdf)) {
                return $this->err('Failed to create searchable PDF.');
            }

            return $this->download($finalPdf, 'searchable-ocr.pdf');
        }

        // ── Plain Text ──────────────────────────────────────────────────────
        foreach ($tmpFiles as $f) @unlink($f);

        if (empty($textParts)) {
            return $this->err('Could not extract text from this PDF. Make sure it is a scanned image-based PDF.');
        }

        $fullText = implode("\n\n", $textParts);

        // JSON format for frontend preview
        if ($format === 'json') {
            return response()->json(['text' => $fullText, 'pages' => count($textParts)]);
        }

        return response($fullText, 200, [
            'Content-Type'        => 'text/plain; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="ocr-output.txt"',
        ]);
    }

    private function tesseractLang(string $lang): string
    {
        $map = [
            'eng' => 'eng', 'english' => 'eng',
            'ben' => 'ben', 'bengali' => 'ben',
            'hin' => 'hin', 'hindi'   => 'hin',
            'ara' => 'ara', 'arabic'  => 'ara',
            'fra' => 'fra', 'french'  => 'fra',
            'deu' => 'deu', 'german'  => 'deu',
            'spa' => 'spa', 'spanish' => 'spa',
            'chi_sim' => 'chi_sim', 'chinese' => 'chi_sim',
            'jpn' => 'jpn', 'japanese' => 'jpn',
            'urd' => 'urd', 'urdu'    => 'urd',
            'por' => 'por', 'portuguese' => 'por',
        ];
        return $map[strtolower($lang)] ?? 'eng';
    }
}
