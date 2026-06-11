<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OcrController extends BasePdfController
{
    /**
     * Run Tesseract OCR on a scanned PDF and return a searchable text file.
     * Steps:
     *  1. Convert each PDF page to a PNG using ImageMagick
     *  2. Run tesseract on each PNG
     *  3. Concatenate text and return as TXT download
     */
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $pdfPath = $this->saveUpload($request->file('file'));
        $lang    = $this->tesseractLang($request->input('lang', 'eng'));

        // Check tesseract is available
        exec('which tesseract 2>/dev/null', $tOut, $tCode);
        if ($tCode !== 0) {
            @unlink($pdfPath);
            return $this->err('OCR is not available on this server. Please contact support.');
        }

        // Get page count (cap at 20 pages for free tier)
        $pageCount = min($this->getPageCount($pdfPath), 20);

        $textParts = [];
        $tmpFiles  = [];

        for ($page = 1; $page <= $pageCount; $page++) {
            // Convert single page to PNG
            $imgPath = $this->outputDir . '/' . Str::random(10) . '_p' . $page . '.png';
            $tmpFiles[] = $imgPath;

            $convertCmd = $this->magick()
                . ' -density 200'
                . ' ' . escapeshellarg($pdfPath . '[' . ($page - 1) . ']')
                . ' -colorspace Gray'
                . ' -quality 90'
                . ' ' . escapeshellarg($imgPath);

            $convertResult = $this->run($convertCmd);

            if (!file_exists($imgPath)) continue;

            // Run Tesseract on the image
            $ocrBase   = $this->outputDir . '/' . Str::random(10) . '_ocr';
            $ocrTxt    = $ocrBase . '.txt';
            $tmpFiles[] = $ocrTxt;

            $ocrCmd = 'tesseract'
                . ' ' . escapeshellarg($imgPath)
                . ' ' . escapeshellarg($ocrBase)
                . ' -l ' . $lang
                . ' 2>/dev/null';

            $this->run($ocrCmd);

            if (file_exists($ocrTxt)) {
                $pageText = trim(file_get_contents($ocrTxt));
                if ($pageText) {
                    $textParts[] = "--- Page {$page} ---\n" . $pageText;
                }
            }
        }

        // Cleanup
        @unlink($pdfPath);
        foreach ($tmpFiles as $f) @unlink($f);

        if (empty($textParts)) {
            return $this->err('Could not extract text from this PDF. Make sure it is a scanned image-based PDF.');
        }

        $fullText = implode("\n\n", $textParts);

        return response($fullText, 200, [
            'Content-Type'        => 'text/plain; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="ocr-output.txt"',
        ]);
    }

    /**
     * Map language name to Tesseract language code.
     */
    private function tesseractLang(string $lang): string
    {
        $map = [
            'eng'     => 'eng',
            'english' => 'eng',
            'ben'     => 'ben',
            'bengali' => 'ben',
            'hin'     => 'hin',
            'hindi'   => 'hin',
            'ara'     => 'ara',
            'arabic'  => 'ara',
            'fra'     => 'fra',
            'french'  => 'fra',
            'deu'     => 'deu',
            'german'  => 'deu',
            'spa'     => 'spa',
            'spanish' => 'spa',
            'chi_sim' => 'chi_sim',
            'chinese' => 'chi_sim',
            'jpn'     => 'jpn',
            'japanese'=> 'jpn',
            'urd'     => 'urd',
            'urdu'    => 'urd',
            'por'     => 'por',
            'portuguese' => 'por',
        ];
        return $map[strtolower($lang)] ?? 'eng';
    }
}
