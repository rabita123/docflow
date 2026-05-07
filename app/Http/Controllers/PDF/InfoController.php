<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class InfoController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $size   = filesize($input);
        $result = $this->run($this->pdftk() . ' ' . escapeshellarg($input) . ' dump_data');
        @unlink($input);

        $data      = $result['stdout'];
        $pages     = 0;
        $encrypted = false;

        if (preg_match('/NumberOfPages: (\d+)/', $data, $m)) $pages = (int) $m[1];
        if (preg_match('/Encryption: (\w+)/',    $data, $m)) $encrypted = strtolower($m[1]) !== 'none';

        $meta = [];
        preg_match_all('/InfoKey: (.+)\nInfoValue: (.+)/', $data, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $meta[strtolower($m[1])] = trim($m[2]);
        }

        return response()->json([
            'pages'        => $pages,
            'encrypted'    => $encrypted,
            'file_size_kb' => round($size / 1024, 1),
            'title'        => $meta['title']        ?? '',
            'author'       => $meta['author']       ?? '',
            'subject'      => $meta['subject']      ?? '',
            'creator'      => $meta['creator']      ?? '',
            'created'      => $meta['creationdate'] ?? '',
            'modified'     => $meta['moddate']      ?? '',
        ]);
    }
}
