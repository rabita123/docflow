<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class WatermarkController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input   = $this->saveUpload($request->file('file'));
        $output  = $this->outputPath('pdf');
        $text    = $request->input('text', 'CONFIDENTIAL');
        $opacity = (float) $request->input('opacity', 0.25);
        $angle   = (int) $request->input('angle', 45);
        $wm_pdf  = $this->outputPath('pdf');
        $ps_file = $this->outputPath('ps');

        $ps = "%!PS-Adobe-3.0\n%%BoundingBox: 0 0 595 842\n"
            . "/Helvetica-Bold findfont 60 scalefont setfont\n"
            . "{$opacity} setgray\n595 2 div 842 2 div translate\n{$angle} rotate\n"
            . "({$text}) dup stringwidth pop -2 div -20 moveto show\nshowpage\n";
        file_put_contents($ps_file, $ps);

        $this->run($this->gs() . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET -sOutputFile=' . escapeshellarg($wm_pdf) . ' ' . escapeshellarg($ps_file));
        @unlink($ps_file);

        if (!file_exists($wm_pdf)) {
            @unlink($input);
            return $this->err('Watermark generation failed.');
        }

        $result = $this->run($this->pdftk() . ' ' . escapeshellarg($input) . ' multistamp ' . escapeshellarg($wm_pdf) . ' output ' . escapeshellarg($output));
        @unlink($input);
        @unlink($wm_pdf);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Watermark failed: ' . $result['stdout']);
        }
        return $this->download($output, 'watermarked.pdf');
    }
}
