<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use ZipArchive;

class SplitController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $input  = $this->saveUpload($request->file('file'));
        $method = $request->input('method', 'every');
        $n      = max(1, (int) $request->input('n', 1));
        $ranges = $request->input('ranges', '');

        // Get page count
        $pages = $this->getPageCount($input);

        // Build page ranges
        $parts = [];
        if ($method === 'half') {
            $mid   = (int) ceil($pages / 2);
            $parts = [
                ['start' => 1,      'end' => $mid],
                ['start' => $mid+1, 'end' => $pages],
            ];
        } elseif ($method === 'range' && $ranges) {
            foreach (explode(',', $ranges) as $seg) {
                $seg = trim($seg);
                if (str_contains($seg, '-')) {
                    [$a, $b] = explode('-', $seg, 2);
                    $parts[] = ['start' => (int)$a, 'end' => (int)$b];
                } elseif (is_numeric($seg)) {
                    $parts[] = ['start' => (int)$seg, 'end' => (int)$seg];
                }
            }
        } else {
            for ($i = 1; $i <= $pages; $i += $n) {
                $parts[] = ['start' => $i, 'end' => min($i + $n - 1, $pages)];
            }
        }

        $zipPath  = $this->outputPath('zip');
        $zip      = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE);
        $tmpFiles = [];

        foreach ($parts as $idx => $part) {
            $tmp   = $this->outputPath('pdf');
            $range = $part['start'] . '-' . $part['end'];
            $cmd   = $this->pdftk() . ' ' . escapeshellarg($input)
                   . ' cat ' . $range
                   . ' output ' . escapeshellarg($tmp);

            $result = $this->run($cmd);
            if ($result['ok'] && file_exists($tmp)) {
                $zip->addFile($tmp, 'part_' . ($idx + 1) . '.pdf');
                $tmpFiles[] = $tmp;
            }
        }

        $zip->close();
        @unlink($input);
        foreach ($tmpFiles as $t) @unlink($t);

        return $this->download($zipPath, 'split_parts.zip', 'application/zip');
    }
}
