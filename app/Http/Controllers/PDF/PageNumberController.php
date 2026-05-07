<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class PageNumberController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input    = $this->saveUpload($request->file('file'));
        $output   = $this->outputPath('pdf');
        $position = $request->input('position', 'bottom-center');
        $prefix   = $request->input('prefix', '');
        $start    = (int) $request->input('start', 1);
        $pages    = $this->getPageCount($input);

        [$px, $py] = match($position) {
            'bottom-right' => ['520', '20'],
            'bottom-left'  => ['20',  '20'],
            'top-center'   => ['297', '820'],
            default        => ['297', '20'],
        };

        $ps = "%!PS-Adobe-3.0\n";
        for ($i = 1; $i <= $pages; $i++) {
            $num  = $prefix . ($i + $start - 1);
            $ps  .= "/Helvetica findfont 11 scalefont setfont\n0 setgray\n{$px} {$py} moveto ({$num}) show\nshowpage\n";
        }

        $ps_file = $this->outputPath('ps');
        $wm_pdf  = $this->outputPath('pdf');
        file_put_contents($ps_file, $ps);

        $this->run($this->gs() . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET -sOutputFile=' . escapeshellarg($wm_pdf) . ' ' . escapeshellarg($ps_file));
        @unlink($ps_file);

        $result = $this->run($this->pdftk() . ' ' . escapeshellarg($input) . ' multistamp ' . escapeshellarg($wm_pdf) . ' output ' . escapeshellarg($output));
        @unlink($input);
        @unlink($wm_pdf);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Page numbering failed: ' . $result['stdout']);
        }
        return $this->download($output, 'page_numbers.pdf');
    }
}
