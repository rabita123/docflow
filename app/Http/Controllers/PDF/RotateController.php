<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class RotateController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $output = $this->outputPath('pdf');
        $angle  = (int) $request->input('angle', 90);

        $dir = match($angle) {
            90  => 'east',
            180 => 'south',
            270 => 'west',
            default => 'east'
        };

        $cmd    = $this->pdftk() . ' ' . escapeshellarg($input) . ' rotate 1-end' . $dir . ' output ' . escapeshellarg($output);
        $result = $this->run($cmd);
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Rotate failed: ' . $result['stdout']);
        }
        return $this->download($output, 'rotated.pdf');
    }
}
