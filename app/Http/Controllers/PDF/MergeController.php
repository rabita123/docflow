<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class MergeController extends BasePdfController
{
    public function handle(Request $request)
    {
        $files = $request->file('files');

        if (!$files || count($files) < 2) {
            return $this->err('Please upload at least 2 PDF files');
        }

        $inputs = [];
        $output = $this->outputPath('pdf');

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $inputs[] = $this->saveUpload($file);
            }
        }

        if (count($inputs) < 2) {
            return $this->err('Need at least 2 valid PDF files');
        }

        $inputPaths = implode(' ', array_map('escapeshellarg', $inputs));
        $cmd = $this->pdftk() . ' ' . $inputPaths . ' cat output ' . escapeshellarg($output);

        $result = $this->run($cmd);
        foreach ($inputs as $p) @unlink($p);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Merge failed: ' . $result['stdout']);
        }

        return $this->download($output, 'merged.pdf');
    }
}
