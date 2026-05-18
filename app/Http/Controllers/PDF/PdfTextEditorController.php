<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\AI\SummarizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PdfTextEditorController extends SummarizeController
{
    /**
     * Extract text from uploaded PDF and return as JSON for editing.
     */
    public function extract(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid PDF uploaded.'], 400);
        }

        $file = $request->file('file');

        if ($file->getClientOriginalExtension() !== 'pdf' && $file->getMimeType() !== 'application/pdf') {
            return response()->json(['error' => 'Please upload a PDF file.'], 400);
        }

        if ($file->getSize() > 10 * 1024 * 1024) {
            return response()->json(['error' => 'File too large. Max 10MB.'], 400);
        }

        $path = $this->saveUpload($file);
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $text = $this->extractText($path, 30); // up to 30 pages
        @unlink($path);

        if (strlen(trim($text)) < 5) {
            return response()->json(['error' => 'No readable text found. The PDF may be scanned or image-based.'], 400);
        }

        return response()->json([
            'text'          => $text,
            'original_name' => $originalName,
            'char_count'    => strlen($text),
        ]);
    }

    /**
     * Convert edited HTML content to PDF and return as download.
     */
    public function export(Request $request)
    {
        set_time_limit(60);

        $htmlContent = $request->input('content', '');
        $title       = trim($request->input('title', 'Edited Document'));
        $fontSize    = (int) $request->input('font_size', 13);
        $fontFamily  = $request->input('font_family', 'serif');

        if (strlen(strip_tags($htmlContent)) < 1) {
            return response()->json(['error' => 'No content to export.'], 400);
        }

        // Sanitize title
        $title = htmlspecialchars(substr($title, 0, 120));

        // Clamp font size
        $fontSize = max(10, min(20, $fontSize));

        $fontFamilies = [
            'serif'     => 'DejaVu Serif, Georgia, serif',
            'sans'      => 'DejaVu Sans, Arial, sans-serif',
            'mono'      => 'DejaVu Sans Mono, Courier New, monospace',
        ];
        $font = $fontFamilies[$fontFamily] ?? $fontFamilies['serif'];

        $html = $this->buildHtml($htmlContent, $title, $fontSize, $font);

        try {
            require_once base_path('vendor/autoload.php');

            $options = new \Dompdf\Options();
            $options->set('defaultFont', $fontFamily === 'sans' ? 'DejaVu Sans' : ($fontFamily === 'mono' ? 'DejaVu Sans Mono' : 'DejaVu Serif'));
            $options->set('isRemoteEnabled', false);
            $options->set('isHtml5ParserEnabled', true);

            $dompdf = new \Dompdf\Dompdf($options);
            $dompdf->loadHtml($html, 'UTF-8');
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdf = $dompdf->output();
        } catch (\Exception $e) {
            return response()->json(['error' => 'PDF export failed: ' . $e->getMessage()], 500);
        }

        $filename = Str::slug($title ?: 'edited-document') . '.pdf';

        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function buildHtml(string $body, string $title, int $fontSize, string $font): string
    {
        return "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: {$font};
    font-size: {$fontSize}px;
    line-height: 1.8;
    color: #1a1a1a;
    padding: 0;
  }
  .cover {
    background: #1e3a5f;
    color: white;
    padding: 48px 50px 36px;
  }
  .cover h1 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
    color: white;
  }
  .cover-meta {
    font-size: 11px;
    color: rgba(255,255,255,0.55);
  }
  .cover-line {
    width: 50px;
    height: 3px;
    background: #4a90d9;
    margin: 14px 0;
    border-radius: 2px;
  }
  .body {
    padding: 40px 50px 50px;
  }
  p  { margin-bottom: 12px; }
  h1 { font-size: 20px; font-weight: 700; margin: 20px 0 10px; color: #1e3a5f; }
  h2 { font-size: 17px; font-weight: 700; margin: 18px 0 8px; color: #1e3a5f; }
  h3 { font-size: 15px; font-weight: 600; margin: 14px 0 6px; color: #2d5a8e; }
  ul, ol { padding-left: 22px; margin-bottom: 12px; }
  li { margin-bottom: 4px; }
  b, strong { font-weight: 700; }
  i, em { font-style: italic; }
  u { text-decoration: underline; }
  .footer {
    text-align: center;
    padding: 16px;
    font-size: 10px;
    color: #94a3b8;
    border-top: 1px solid #e2e8f0;
    margin-top: 30px;
  }
</style>
</head>
<body>
<div class='cover'>
  <h1>{$title}</h1>
  <div class='cover-line'></div>
  <div class='cover-meta'>Edited with PDFTash · " . date('F j, Y') . " · pdftash.com</div>
</div>
<div class='body'>
{$body}
</div>
<div class='footer'>PDFTash · pdftash.com · " . date('Y') . "</div>
</body>
</html>";
    }
}
