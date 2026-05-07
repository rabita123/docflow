<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class CompressController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $input  = $this->saveUpload($request->file('file'));
        $output = $this->outputPath('pdf');
        $level  = $request->input('level', 'recommended');

        $settings = [
            'high'        => '/screen',
            'recommended' => '/ebook',
            'low'         => '/prepress',
        ];
        $setting = $settings[$level] ?? '/ebook';

        $cmd = $this->gs()
             . ' -sDEVICE=pdfwrite'
             . ' -dCompatibilityLevel=1.4'
             . ' -dPDFSETTINGS=' . $setting
             . ' -dNOPAUSE -dQUIET -dBATCH'
             . ' -sOutputFile=' . escapeshellarg($output)
             . ' ' . escapeshellarg($input);

        $result = $this->run($cmd);
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Compression failed: ' . $result['stdout']);
        }

        return $this->download($output, 'compressed.pdf');
    }
}
