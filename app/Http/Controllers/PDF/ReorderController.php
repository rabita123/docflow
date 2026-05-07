<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class ReorderController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $output = $this->outputPath('pdf');
        $pages  = array_filter(
            array_map('trim', explode(',', $request->input('order', ''))),
            'is_numeric'
        );

        if (empty($pages)) {
            @unlink($input);
            return $this->err('Invalid page order. Use: 3,1,2,4');
        }

        $result = $this->run(
            $this->pdftk() . ' ' . escapeshellarg($input)
            . ' cat ' . implode(' ', $pages)
            . ' output ' . escapeshellarg($output)
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Reorder failed: ' . $result['stdout']);
        }
        return $this->download($output, 'reordered.pdf');
    }
}
