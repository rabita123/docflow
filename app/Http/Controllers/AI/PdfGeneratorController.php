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

        $mode  = $request->input('mode', 'document'); // document | table
        $theme = $request->input('theme', 'professional');

        if ($mode === 'table') {
            return $this->handleTable($request, $theme);
        }

        $topic = trim($request->input('topic', ''));
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

    /* ── TABLE / STATEMENT MODE ──────────────────────────────── */
    private function handleTable(Request $request, string $theme)
    {
        $title      = trim($request->input('title', 'Statement'));
        $subtitle   = trim($request->input('subtitle', ''));
        $columns    = array_filter(array_map('trim', explode(',', $request->input('columns', ''))));
        $rawRows    = trim($request->input('rows', ''));
        $footerNote = trim($request->input('footer_note', ''));

        if (empty($columns)) {
            return response()->json(['error' => 'Please provide at least one column name.'], 400);
        }
        if (empty($rawRows)) {
            return response()->json(['error' => 'Please enter at least one data row.'], 400);
        }

        // Parse rows — each line is one row, values separated by comma or tab
        $rows = [];
        foreach (explode("\n", $rawRows) as $line) {
            $line = trim($line);
            if ($line === '') continue;
            // Support tab or comma separation
            $cells = str_contains($line, "\t")
                ? explode("\t", $line)
                : explode(',', $line);
            $rows[] = array_map('trim', $cells);
        }

        if (empty($rows)) {
            return response()->json(['error' => 'No valid data rows found.'], 400);
        }

        // Auto-detect numeric columns for right-alignment and totals
        $numericCols = [];
        $colCount = count($columns);
        for ($c = 0; $c < $colCount; $c++) {
            $isNum = true;
            foreach ($rows as $row) {
                $val = preg_replace('/[,\s]/', '', $row[$c] ?? '');
                if ($val !== '' && !is_numeric($val)) { $isNum = false; break; }
            }
            if ($isNum) $numericCols[$c] = true;
        }

        // Compute column totals for numeric columns
        $totals = [];
        $hasTotals = false;
        for ($c = 0; $c < $colCount; $c++) {
            if (isset($numericCols[$c])) {
                $sum = 0;
                foreach ($rows as $row) {
                    $sum += (float) preg_replace('/[,\s]/', '', $row[$c] ?? '0');
                }
                $totals[$c] = number_format($sum, 0);
                $hasTotals  = true;
            } else {
                $totals[$c] = null;
            }
        }

        $html = $this->buildTableHtml($title, $subtitle, $columns, $rows, $numericCols, $totals, $hasTotals, $footerNote, $theme);

        try {
            $pdf = $this->htmlToPdf($html);
        } catch (\Exception $e) {
            return response()->json(['error' => 'PDF generation failed: ' . $e->getMessage()], 500);
        }

        $filename = \Illuminate\Support\Str::slug($title) . '-table.pdf';
        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function buildTableHtml(
        string $title, string $subtitle,
        array $columns, array $rows,
        array $numericCols, array $totals, bool $hasTotals,
        string $footerNote, string $theme
    ): string {
        $themes = [
            'professional' => ['primary'=>'#1e40af','accent'=>'#3b82f6','hdr'=>'#dbeafe','alt'=>'#f0f7ff','text'=>'#1e293b'],
            'dark'         => ['primary'=>'#312e81','accent'=>'#6366f1','hdr'=>'#1e1b4b','alt'=>'#1e1e30','text'=>'#e2e8f0'],
            'green'        => ['primary'=>'#065f46','accent'=>'#10b981','hdr'=>'#d1fae5','alt'=>'#f0fdf4','text'=>'#1e293b'],
            'purple'       => ['primary'=>'#4c1d95','accent'=>'#8b5cf6','hdr'=>'#ede9fe','alt'=>'#f5f3ff','text'=>'#1e293b'],
            'red'          => ['primary'=>'#991b1b','accent'=>'#ef4444','hdr'=>'#fee2e2','alt'=>'#fff5f5','text'=>'#1e293b'],
        ];
        $t = $themes[$theme] ?? $themes['professional'];

        // Build header row
        $thCells = '';
        foreach ($columns as $i => $col) {
            $align = isset($numericCols[$i]) ? 'right' : 'left';
            $thCells .= "<th style='text-align:{$align}'>" . htmlspecialchars($col) . "</th>";
        }

        // Build data rows
        $trRows = '';
        foreach ($rows as $ri => $row) {
            $bgStyle = ($ri % 2 === 1) ? "background:{$t['alt']};" : '';
            $tds = '';
            for ($ci = 0; $ci < count($columns); $ci++) {
                $val   = htmlspecialchars($row[$ci] ?? '');
                $align = isset($numericCols[$ci]) ? 'right' : 'left';
                // Format numbers with comma separators if numeric
                if (isset($numericCols[$ci]) && $val !== '') {
                    $num = (float) preg_replace('/[,\s]/', '', $val);
                    $val = number_format($num, strpos($val, '.') !== false ? 2 : 0);
                }
                $tds .= "<td style='text-align:{$align}'>{$val}</td>";
            }
            $trRows .= "<tr style='{$bgStyle}'>{$tds}</tr>";
        }

        // Totals row
        $totalsRow = '';
        if ($hasTotals) {
            $tds = '';
            $firstTotal = true;
            for ($ci = 0; $ci < count($columns); $ci++) {
                $align = isset($numericCols[$ci]) ? 'right' : 'left';
                if ($totals[$ci] !== null) {
                    $tds .= "<td style='text-align:{$align};font-weight:700;color:{$t['primary']}'>{$totals[$ci]}</td>";
                } else {
                    $label = $firstTotal ? '<strong>Total</strong>' : '';
                    $tds .= "<td style='text-align:{$align};font-weight:700'>{$label}</td>";
                    $firstTotal = false;
                }
            }
            $totalsRow = "<tr style='background:{$t['hdr']};border-top:2px solid {$t['accent']}'>{$tds}</tr>";
        }

        $rowCount   = count($rows);
        $colCount   = count($columns);
        $subtitleHtml = $subtitle ? "<div style='color:rgba(255,255,255,.75);font-size:13px;margin-top:6px'>" . htmlspecialchars($subtitle) . "</div>" : '';
        $footerHtml = $footerNote
            ? "<div style='margin-top:16px;padding:10px 14px;background:{$t['hdr']};border-left:3px solid {$t['accent']};border-radius:0 6px 6px 0;font-size:10px;color:{$t['text']}'>" . nl2br(htmlspecialchars($footerNote)) . "</div>"
            : '';

        return "<!DOCTYPE html>
<html><head><meta charset='UTF-8'>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size:11px; color:{$t['text']}; background:#f8fafc; }
.cover { background:{$t['primary']}; color:white; padding:36px 40px 28px; }
.cover h1 { font-size:22px; font-weight:800; margin-bottom:4px; }
.cover-meta { font-size:9px; color:rgba(255,255,255,.5); margin-top:10px; }
.body { padding:28px 40px; }
.stats { display:flex; gap:16px; margin-bottom:24px; }
.stat-box { flex:1; background:white; border:1px solid rgba(0,0,0,.08); border-radius:8px; padding:12px 16px; border-top:3px solid {$t['accent']}; }
.stat-label { font-size:9px; font-weight:700; text-transform:uppercase; color:#94a3b8; letter-spacing:.06em; margin-bottom:4px; }
.stat-val { font-size:16px; font-weight:800; color:{$t['primary']}; }
table { width:100%; border-collapse:collapse; border-radius:8px; overflow:hidden; }
thead tr { background:{$t['primary']}; color:white; }
thead th { padding:10px 12px; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; border:none; }
tbody td { padding:8px 12px; font-size:11px; border-bottom:1px solid rgba(0,0,0,.06); }
tfoot tr { background:{$t['hdr']}; }
tfoot td { padding:9px 12px; font-size:11px; border-top:2px solid {$t['accent']}; }
.footer { text-align:center; padding:20px; font-size:9px; color:#94a3b8; border-top:1px solid rgba(0,0,0,.06); margin-top:24px; }
</style>
</head><body>

<div class='cover'>
  <div style='font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.6);margin-bottom:8px'>✦ PDFTash · Table Report</div>
  <h1>" . htmlspecialchars($title) . "</h1>
  {$subtitleHtml}
  <div class='cover-meta'>Generated " . date('d M Y, H:i') . " · {$rowCount} rows · {$colCount} columns</div>
</div>

<div class='body'>

  <div class='stats'>
    <div class='stat-box'>
      <div class='stat-label'>Total Rows</div>
      <div class='stat-val'>{$rowCount}</div>
    </div>
    <div class='stat-box'>
      <div class='stat-label'>Columns</div>
      <div class='stat-val'>{$colCount}</div>
    </div>" .
    ($hasTotals ? "
    <div class='stat-box'>
      <div class='stat-label'>Total (last numeric col)</div>
      <div class='stat-val'>" . array_values(array_filter($totals, fn($v) => $v !== null))[count(array_filter($totals, fn($v) => $v !== null))-1] . "</div>
    </div>" : "") . "
  </div>

  <table>
    <thead><tr>{$thCells}</tr></thead>
    <tbody>{$trRows}</tbody>" .
    ($totalsRow ? "<tfoot>{$totalsRow}</tfoot>" : "") . "
  </table>

  {$footerHtml}
</div>

<div class='footer'>Generated by PDFTash · pdftash.com · " . date('Y') . "</div>
</body></html>";
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
