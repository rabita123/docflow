<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OcrController extends BasePdfController
{
    /**
     * OCR a scanned PDF.
     *
     * format=json  → JSON {text, pages} for frontend preview (fast, txt only)
     * format=txt   → plain text download
     * format=pdf   → searchable PDF using ocrmypdf (invisible text layer over original image)
     */
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $pdfPath = $this->saveUpload($request->file('file'));
        $lang    = $this->tesseractLang($request->input('lang', 'eng'));
        $format  = in_array($request->input('format'), ['txt', 'pdf', 'json'])
                   ? $request->input('format')
                   : 'json';

        // ── Searchable PDF via ocrmypdf ────────────────────────────────────
        if ($format === 'pdf') {
            return $this->makeSearchablePdf($pdfPath, $lang);
        }

        // ── Plain text / JSON preview via Tesseract ────────────────────────
        return $this->extractToText($pdfPath, $lang, $format);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Searchable PDF: uses ocrmypdf to add invisible text layer over original
    // ─────────────────────────────────────────────────────────────────────────
    private function makeSearchablePdf(string $pdfPath, string $lang)
    {
        $outputPdf = $this->outputPath('pdf');

        // Find ocrmypdf full path (www-data may have limited PATH)
        exec('which ocrmypdf 2>/dev/null', $out, $code);
        $ocrmypdfBin = ($code === 0 && !empty($out[0])) ? trim($out[0]) : '/usr/local/bin/ocrmypdf';

        if (file_exists($ocrmypdfBin) || $code === 0) {
            $cmd = escapeshellarg($ocrmypdfBin)
                . ' -l ' . escapeshellarg($lang)
                . ' --output-type pdf'
                . ' --optimize 0'         // no optimization — avoids pngquant dependency
                . ' --skip-text'          // skip pages that already have text, OCR image pages
                . ' ' . escapeshellarg($pdfPath)
                . ' ' . escapeshellarg($outputPdf)
                . ' 2>&1';

            $result = $this->run($cmd);
            @unlink($pdfPath);

            if (file_exists($outputPdf) && filesize($outputPdf) > 1024) {
                return $this->download($outputPdf, 'searchable-ocr.pdf');
            }

            // Log what went wrong
            \Illuminate\Support\Facades\Log::error('OCR failed', [
                'cmd'    => $cmd,
                'output' => $result['stdout'] ?? '',
                'exists' => file_exists($outputPdf),
                'size'   => file_exists($outputPdf) ? filesize($outputPdf) : 0,
            ]);
        }

        @unlink($pdfPath);
        return $this->err('OCR processing failed. Please try a different PDF.');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Text extraction: page-by-page via ImageMagick + Tesseract
    // ─────────────────────────────────────────────────────────────────────────
    private function extractToText(string $pdfPath, string $lang, string $format)
    {
        exec('which tesseract 2>/dev/null', $tOut, $tCode);
        if ($tCode !== 0) {
            @unlink($pdfPath);
            return $this->err('OCR (tesseract) is not available on this server.');
        }

        $pageCount = min($this->getPageCount($pdfPath), 20);
        $textParts = [];
        $tmpFiles  = [];

        for ($page = 1; $page <= $pageCount; $page++) {
            $imgPath    = $this->outputDir . '/' . Str::random(10) . '_p' . $page . '.png';
            $tmpFiles[] = $imgPath;

            $this->run(
                $this->magick()
                . ' -density 300'
                . ' ' . escapeshellarg($pdfPath . '[' . ($page - 1) . ']')
                . ' -colorspace Gray -quality 95'
                . ' ' . escapeshellarg($imgPath)
            );

            if (!file_exists($imgPath)) continue;

            $ocrBase    = $this->outputDir . '/' . Str::random(10) . '_ocr';
            $ocrTxt     = $ocrBase . '.txt';
            $tmpFiles[] = $ocrTxt;

            $this->run(
                'tesseract ' . escapeshellarg($imgPath)
                . ' ' . escapeshellarg($ocrBase)
                . ' -l ' . $lang
                . ' --psm 6 2>/dev/null'
            );

            if (file_exists($ocrTxt)) {
                $pageText = trim(file_get_contents($ocrTxt));
                if ($pageText) $textParts[] = "--- Page {$page} ---\n" . $pageText;
            }
        }

        @unlink($pdfPath);
        foreach ($tmpFiles as $f) @unlink($f);

        if (empty($textParts)) {
            return $this->err('Could not extract text. Make sure this is a scanned (image-based) PDF with clear text.');
        }

        $fullText = implode("\n\n", $textParts);

        if ($format === 'json') {
            return response()->json(['text' => $fullText, 'pages' => count($textParts)]);
        }

        return response($fullText, 200, [
            'Content-Type'        => 'text/plain; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="ocr-output.txt"',
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function tesseractLang(string $lang): string
    {
        $map = [
            'eng' => 'eng', 'english'    => 'eng',
            'ben' => 'ben', 'bengali'    => 'ben',
            'hin' => 'hin', 'hindi'      => 'hin',
            'ara' => 'ara', 'arabic'     => 'ara',
            'fra' => 'fra', 'french'     => 'fra',
            'deu' => 'deu', 'german'     => 'deu',
            'spa' => 'spa', 'spanish'    => 'spa',
            'chi_sim' => 'chi_sim', 'chinese'  => 'chi_sim',
            'jpn' => 'jpn', 'japanese'   => 'jpn',
            'urd' => 'urd', 'urdu'       => 'urd',
            'por' => 'por', 'portuguese' => 'por',
        ];
        return $map[strtolower($lang)] ?? 'eng';
    }
}
