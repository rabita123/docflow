<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SignController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $input     = $this->saveUpload($request->file('file'));
        $signType  = $request->input('sign_type', 'image');
        $placement = $request->input('placement', 'last'); // first | last | all | custom
        $customPage= max(1, (int) $request->input('page', 1));
        $xPct      = (float) $request->input('x', 10);
        $yPct      = (float) $request->input('y', 85); // from top
        $width     = (float) $request->input('width', 150);
        $height    = (float) $request->input('height', 50);

        // Get page count and dimensions
        $infoResult = $this->run($this->pdftk() . ' ' . escapeshellarg($input) . ' dump_data');
        $totalPages = $this->getPageCount($input);
        $pageWidth  = 595.0;
        $pageHeight = 842.0;
        if (preg_match('/PageMediaWidth: ([\d.]+)/',  $infoResult['stdout'], $m)) $pageWidth  = (float)$m[1];
        if (preg_match('/PageMediaHeight: ([\d.]+)/', $infoResult['stdout'], $m)) $pageHeight = (float)$m[1];

        // Determine target pages
        $targetPages = match($placement) {
            'first'  => [1],
            'last'   => [$totalPages],
            'all'    => range(1, $totalPages),
            'custom' => [$customPage],
            default  => [$totalPages],
        };

        // Convert position % to PDF points
        $xPoint = ($xPct / 100) * $pageWidth;
        $yPoint = $pageHeight - (($yPct / 100) * $pageHeight) - $height;

        // Get signature image
        if ($signType === 'text') {
            $signText = $request->input('sign_text', 'Signature');
            $fontSize = (int) $request->input('font_size', 28);
            $output   = $this->applyTextSign($input, $signText, $xPoint, $yPoint, $fontSize, $targetPages, $totalPages, $pageWidth, $pageHeight);
        } else {
            if ($request->has('sign_image')) {
                $base64  = preg_replace('/^data:image\/\w+;base64,/', '', $request->input('sign_image'));
                $imgData = base64_decode($base64);
                if (!$imgData) { @unlink($input); return $this->err('Invalid signature image.'); }
                $signImg = $this->outputDir . DIRECTORY_SEPARATOR . Str::random(10) . '.png';
                file_put_contents($signImg, $imgData);
            } elseif ($request->hasFile('sign_file')) {
                $signImg = $this->saveUpload($request->file('sign_file'));
            } else {
                @unlink($input);
                return $this->err('No signature provided.');
            }

            $output = $this->applyImageSign($input, $signImg, $xPoint, $yPoint, $width, $height, $targetPages, $totalPages, $pageWidth, $pageHeight);
            @unlink($signImg);
        }

        @unlink($input);

        if (!$output || !file_exists($output)) {
            return $this->err('Signature failed.');
        }

        return $this->download($output, 'signed.pdf');
    }

    private function applyImageSign(
        string $input, string $signImg,
        float $x, float $y, float $w, float $h,
        array $targetPages, int $totalPages,
        float $pageWidth, float $pageHeight
    ): string {
        // Step 1: Create stamp PDF with signature only on target pages
        $stampPdf = $this->outputPath('pdf');
        $psTmp    = $this->outputPath('ps');
        $psImgPath = str_replace('\\', '/', $signImg);

        $ps = "%!PS-Adobe-3.0\n";
        for ($i = 1; $i <= $totalPages; $i++) {
            if (in_array($i, $targetPages)) {
                $ps .= "gsave\n";
                $ps .= "{$x} {$y} translate\n";
                $ps .= "{$w} {$h} scale\n";
                $ps .= "({$psImgPath}) run\n";
                $ps .= "grestore\n";
            }
            $ps .= "showpage\n";
        }
        file_put_contents($psTmp, $ps);

        $r = $this->run(
            $this->gs() . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET'
            . ' -dDEVICEWIDTHPOINTS=' . (int)$pageWidth
            . ' -dDEVICEHEIGHTPOINTS=' . (int)$pageHeight
            . ' -sOutputFile=' . escapeshellarg($stampPdf)
            . ' ' . escapeshellarg($psTmp)
        );
        @unlink($psTmp);

        // Fallback if PS approach fails
        if (!file_exists($stampPdf) || !$r['ok']) {
            // Convert PNG to PDF
            $pngPdf = $this->outputPath('pdf');
            $this->run(
                $this->gs() . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET'
                . ' -dDEVICEWIDTHPOINTS=' . (int)$pageWidth
                . ' -dDEVICEHEIGHTPOINTS=' . (int)$pageHeight
                . ' -sOutputFile=' . escapeshellarg($pngPdf)
                . ' ' . escapeshellarg($signImg)
            );
            if (file_exists($pngPdf)) {
                @rename($pngPdf, $stampPdf);
            }
        }

        if (!file_exists($stampPdf)) return '';

        // Step 2: Use pdftk multistamp (applies stamp page N to PDF page N)
        $output = $this->outputPath('pdf');
        $result = $this->run(
            $this->pdftk() . ' ' . escapeshellarg($input)
            . ' multistamp ' . escapeshellarg($stampPdf)
            . ' output ' . escapeshellarg($output)
        );
        @unlink($stampPdf);

        return ($result['ok'] && file_exists($output)) ? $output : '';
    }

    private function applyTextSign(
        string $input, string $text,
        float $x, float $y, int $fontSize,
        array $targetPages, int $totalPages,
        float $pageWidth, float $pageHeight
    ): string {
        $stampPdf = $this->outputPath('pdf');
        $psTmp    = $this->outputPath('ps');

        $ps = "%!PS-Adobe-3.0\n";
        for ($i = 1; $i <= $totalPages; $i++) {
            if (in_array($i, $targetPages)) {
                $ps .= "/Helvetica-BoldOblique findfont {$fontSize} scalefont setfont\n";
                $ps .= "0 0 0 setrgbcolor\n";
                $ps .= "{$x} {$y} moveto ({$text}) show\n";
            }
            $ps .= "showpage\n";
        }
        file_put_contents($psTmp, $ps);

        $this->run(
            $this->gs() . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET'
            . ' -dDEVICEWIDTHPOINTS=' . (int)$pageWidth
            . ' -dDEVICEHEIGHTPOINTS=' . (int)$pageHeight
            . ' -sOutputFile=' . escapeshellarg($stampPdf)
            . ' ' . escapeshellarg($psTmp)
        );
        @unlink($psTmp);

        if (!file_exists($stampPdf)) return '';

        $output = $this->outputPath('pdf');
        $result = $this->run(
            $this->pdftk() . ' ' . escapeshellarg($input)
            . ' multistamp ' . escapeshellarg($stampPdf)
            . ' output ' . escapeshellarg($output)
        );
        @unlink($stampPdf);

        return ($result['ok'] && file_exists($output)) ? $output : '';
    }
}
