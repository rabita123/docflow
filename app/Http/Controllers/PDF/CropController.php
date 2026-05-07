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

        $result = $this->run(
            $this->gs() . ' -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dQUIET'
            . ' -sOutputFile=' . escapeshellarg($output)
            . ' ' . escapeshellarg($input)
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Crop failed: ' . $result['stdout']);
        }
        return $this->download($output, 'cropped.pdf');
    }
}
