<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class DeletePagesController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);
        $input    = $this->saveUpload($request->file('file'));
        $output   = $this->outputPath('pdf');
        $pages    = $request->input('pages', '');
        $total    = $this->getPageCount($input);
        $toDelete = $this->parseList($pages, $total);
        $toKeep   = array_values(array_diff(range(1, $total), $toDelete));

        if (empty($toKeep)) {
            @unlink($input);
            return $this->err('Cannot delete all pages.');
        }

        $result = $this->run(
            $this->pdftk() . ' ' . escapeshellarg($input)
            . ' cat ' . implode(' ', $toKeep)
            . ' output ' . escapeshellarg($output)
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Delete pages failed: ' . $result['stdout']);
        }
        return $this->download($output, 'pages_deleted.pdf');
    }

    private function parseList(string $pages, int $total): array
    {
        $list = [];
        foreach (explode(',', $pages) as $token) {
            $token = trim($token);
            if (str_contains($token, '-')) {
                [$a, $b] = explode('-', $token, 2);
                $list = array_merge($list, range((int)$a, min((int)$b, $total)));
            } elseif (is_numeric($token)) {
                $list[] = (int) $token;
            }
        }
        return array_unique($list);
    }
}
