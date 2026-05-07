<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;

class SecurityController extends BasePdfController
{
    public function protect(Request $request)
    {
        $this->needsFile($request);
        $input    = $this->saveUpload($request->file('file'));
        $output   = $this->outputPath('pdf');
        $password = $request->input('password', '');

        if (empty($password)) {
            @unlink($input);
            return $this->err('Password is required.');
        }

        $result = $this->run(
            $this->pdftk() . ' ' . escapeshellarg($input)
            . ' output ' . escapeshellarg($output)
            . ' user_pw ' . escapeshellarg($password)
            . ' owner_pw ' . escapeshellarg($password . '_owner')
            . ' encrypt_128bit'
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Protect failed: ' . $result['stdout']);
        }
        return $this->download($output, 'protected.pdf');
    }

    public function unlock(Request $request)
    {
        $this->needsFile($request);
        $input    = $this->saveUpload($request->file('file'));
        $output   = $this->outputPath('pdf');
        $password = $request->input('password', '');

        $result = $this->run(
            $this->pdftk() . ' ' . escapeshellarg($input)
            . ' input_pw ' . escapeshellarg($password)
            . ' output ' . escapeshellarg($output)
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Unlock failed. Wrong password?', 401);
        }
        return $this->download($output, 'unlocked.pdf');
    }
}
