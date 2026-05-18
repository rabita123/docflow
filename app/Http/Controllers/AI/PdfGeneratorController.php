<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PdfGeneratorController extends SummarizeController
{
    protected string $model = 'claude-haiku-4-5-20251001';

    public function handle(Request $request)
    {
        set_time_limit(180);

        $topic  = trim($request->input('topic', ''));
        $theme  = $request->input('theme', 'professional');
        $type   = $request->input('type', 'document'); // document | presentation

        if (strlen($topic) < 10) {
            return response()->json(['error' => 'Please enter at least 10 characters.'], 400);
        }

        // Step 1: Ask Claude to structure the content beautifully
        $prompt = "You are a professional document designer. The user wants to create a beautiful PDF document.\n\n"
            . "User input: \"{$topic}\"\n\n"
            . "Create a well-structured document with:\n"
            . "1. A compelling TITLE\n"
            . "2. A brief SUBTITLE or tagline\n"
            . "3. An INTRODUCTION paragraph (2-3 sentences)\n"
            . "4. 3-5 SECTIONS, each with:\n"
            . "   - Section heading\n"
            . "   - 3-4 bullet points or short paragraphs\n"
            . "5. A CONCLUSION paragraph\n\n"
            . "Return ONLY valid JSON in this exact format, no markdown:\n"
            . '{"title":"...","subtitle":"...","introduction":"...","sections":[{"heading":"...","content":["bullet1","bullet2","bullet3"]}],"conclusion":"..."}';

        try {
            $raw  = $this->claude($prompt, 2000);
            // Extract JSON even if Claude wraps it
            preg_match('/\{.*\}/s', $raw, $matches);
            $data = json_decode($matches[0] ?? $raw, true);

            if (!$data || !isset($data['title'])) {
                return response()->json(['error' => 'AI could not structure the content. Please try again.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'AI error: ' . $e->getMessage()], 500);
        }

        // Step 2: Generate beautiful HTML
        $html  = $this->buildHtml($data, $theme);

        // Step 3: Convert to PDF using dompdf
        try {
            $pdf = $this->htmlToPdf($html);
        } catch (\Exception $e) {
            return response()->json(['error' => 'PDF generation failed: ' . $e->getMessage()], 500);
        }

        $filename = Str::slug($data['title'] ?? 'document') . '.pdf';

        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function buildHtml(array $data, string $theme): string
    {
        $themes = [
            'professional' => ['primary' => '#1e40af', 'accent' => '#3b82f6', 'bg' => '#eff6ff', 'text' => '#1e293b'],
            'dark'         => ['primary' => '#0f172a', 'accent' => '#6366f1', 'bg' => '#1e1e2e', 'text' => '#e2e8f0'],
            'green'        => ['primary' => '#065f46', 'accent' => '#10b981', 'bg' => '#ecfdf5', 'text' => '#1e293b'],
            'purple'       => ['primary' => '#4c1d95', 'accent' => '#8b5cf6', 'bg' => '#f5f3ff', 'text' => '#1e293b'],
            'red'          => ['primary' => '#991b1b', 'accent' => '#ef4444', 'bg' => '#fef2f2', 'text' => '#1e293b'],
        ];

        $t = $themes[$theme] ?? $themes['professional'];

        $sectionsHtml = '';
        foreach (($data['sections'] ?? []) as $i => $section) {
            $bullets = '';
            foreach (($section['content'] ?? []) as $bullet) {
                $bullets .= '<li>' . htmlspecialchars($bullet) . '</li>';
            }
            $sectionsHtml .= "
            <div class='section'>
                <h2><span class='num'>" . ($i + 1) . "</span> " . htmlspecialchars($section['heading'] ?? '') . "</h2>
                <ul>{$bullets}</ul>
            </div>";
        }

        $isDark = $theme === 'dark';
        $cardBg = $isDark ? '#2d2d42' : '#ffffff';
        $bodyBg = $isDark ? '#1e1e2e' : '#f8fafc';

        return "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: DejaVu Sans, Arial, sans-serif;
    background: {$bodyBg};
    color: {$t['text']};
    font-size: 12px;
    line-height: 1.7;
    padding: 0;
  }
  .cover {
    background: {$t['primary']};
    color: white;
    padding: 60px 50px 50px;
    min-height: 200px;
    position: relative;
  }
  .cover-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.9);
    padding: 4px 14px;
    border-radius: 99px;
    font-size: 10px;
    font-weight: bold;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 20px;
  }
  .cover h1 {
    font-size: 30px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 14px;
    color: white;
  }
  .cover .subtitle {
    font-size: 14px;
    color: rgba(255,255,255,0.75);
    margin-bottom: 30px;
  }
  .cover-line {
    width: 60px;
    height: 4px;
    background: {$t['accent']};
    border-radius: 2px;
    margin-bottom: 20px;
  }
  .cover-meta {
    font-size: 10px;
    color: rgba(255,255,255,0.5);
  }
  .body { padding: 40px 50px; }
  .intro-box {
    background: {$t['bg']};
    border-left: 4px solid {$t['accent']};
    padding: 18px 22px;
    border-radius: 0 8px 8px 0;
    margin-bottom: 36px;
    font-size: 12.5px;
    color: {$t['text']};
    line-height: 1.8;
  }
  .section {
    background: {$cardBg};
    border-radius: 10px;
    padding: 22px 26px;
    margin-bottom: 20px;
    border: 1px solid rgba(0,0,0,0.07);
  }
  .section h2 {
    font-size: 14px;
    font-weight: 700;
    color: {$t['primary']};
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .section h2 .num {
    background: {$t['accent']};
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 800;
    flex-shrink: 0;
  }
  .section ul {
    padding-left: 20px;
    list-style: none;
  }
  .section ul li {
    padding: 4px 0 4px 16px;
    position: relative;
    color: {$t['text']};
    font-size: 12px;
    line-height: 1.6;
  }
  .section ul li:before {
    content: '▸';
    position: absolute;
    left: 0;
    color: {$t['accent']};
    font-size: 11px;
  }
  .conclusion {
    background: {$t['primary']};
    color: white;
    border-radius: 10px;
    padding: 24px 28px;
    margin-top: 28px;
    font-size: 12.5px;
    line-height: 1.8;
  }
  .conclusion h3 {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 10px;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 0.08em;
  }
  .footer {
    text-align: center;
    padding: 24px;
    font-size: 10px;
    color: #94a3b8;
    border-top: 1px solid rgba(0,0,0,0.07);
    margin-top: 30px;
  }
</style>
</head>
<body>

<div class='cover'>
  <div class='cover-badge'>✦ AI Generated by PDFTash</div>
  <h1>" . htmlspecialchars($data['title'] ?? 'Document') . "</h1>
  <div class='subtitle'>" . htmlspecialchars($data['subtitle'] ?? '') . "</div>
  <div class='cover-line'></div>
  <div class='cover-meta'>Generated on " . date('F j, Y') . " · pdftash.com</div>
</div>

<div class='body'>

  <div class='intro-box'>" . htmlspecialchars($data['introduction'] ?? '') . "</div>

  {$sectionsHtml}

  <div class='conclusion'>
    <h3>Conclusion</h3>
    " . htmlspecialchars($data['conclusion'] ?? '') . "
  </div>

</div>

<div class='footer'>Generated by PDFTash AI · pdftash.com · " . date('Y') . "</div>

</body>
</html>";
    }

    private function htmlToPdf(string $html): string
    {
        require_once base_path('vendor/autoload.php');

        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', false);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }
}
