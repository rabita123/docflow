<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class CropController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $output = $this->outputPath('pdf');

        $x1 = max(0,   min(100, (float) $request->input('crop_x1', 0)));
        $y1 = max(0,   min(100, (float) $request->input('crop_y1', 0)));
        $x2 = max(0,   min(100, (float) $request->input('crop_x2', 100)));
        $y2 = max(0,   min(100, (float) $request->input('crop_y2', 100)));

        // --- Step 1: get page MediaBox via a tiny PostScript script --------
        $psFile = sys_get_temp_dir() . '/pdfcrop_size_' . uniqid() . '.ps';
        file_put_contents($psFile,
            '(' . addslashes($input) . ") (r) file runpdfbegin\n" .
            "1 pdfgetpage /MediaBox pget pop aload pop\n" .
            "4 { = flush } repeat\n" .
            "quit\n"
        );

        $sizeOut = [];
        exec($this->gs() . ' -q -dNODISPLAY -dNOSAFER ' . escapeshellarg($psFile) . ' 2>/dev/null', $sizeOut);
        @unlink($psFile);

        // Parse llx lly urx ury — fallback to A4 if detection fails
        $llx = isset($sizeOut[0]) ? (float) trim($sizeOut[0]) : 0;
        $lly = isset($sizeOut[1]) ? (float) trim($sizeOut[1]) : 0;
        $urx = isset($sizeOut[2]) ? (float) trim($sizeOut[2]) : 595;
        $ury = isset($sizeOut[3]) ? (float) trim($sizeOut[3]) : 842;

        $pageW = $urx - $llx;
        $pageH = $ury - $lly;

        if ($pageW < 1 || $pageH < 1) { $pageW = 595; $pageH = 842; }

        // --- Step 2: convert % to PDF points (Y-axis is bottom-up in PDF) --
        $cropX1 = $llx + ($x1 / 100) * $pageW;
        $cropY1 = $lly + (1 - $y2 / 100) * $pageH;   // flip Y: screen top→pdf bottom
        $cropX2 = $llx + ($x2 / 100) * $pageW;
        $cropY2 = $lly + (1 - $y1 / 100) * $pageH;

        $cropW = round($cropX2 - $cropX1, 2);
        $cropH = round($cropY2 - $cropY1, 2);

        if ($cropW < 5 || $cropH < 5) {
            @unlink($input);
            return $this->err('Crop selection too small. Please drag a larger area.');
        }

        // --- Step 3: crop using Ghostscript page offset + fixed media -------
        $offsetX = round(-$cropX1, 2);
        $offsetY = round(-$cropY1, 2);

        $result = $this->run(
            $this->gs()
            . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET'
            . ' -dDEVICEWIDTHPOINTS='  . $cropW
            . ' -dDEVICEHEIGHTPOINTS=' . $cropH
            . ' -dFIXEDMEDIA'
            . ' -sOutputFile=' . escapeshellarg($output)
            . ' -c ' . escapeshellarg('<</PageOffset [' . $offsetX . ' ' . $offsetY . ']>> setpagedevice')
            . ' -f '  . escapeshellarg($input)
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output) || filesize($output) < 100) {
            return $this->err('Crop failed. ' . ($result['stdout'] ?? ''));
        }
        return $this->download($output, 'cropped.pdf');
    }
}
