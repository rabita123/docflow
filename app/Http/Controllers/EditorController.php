<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EditorController extends Controller
{
    private const TEMP_DIR = 'pdf_temp';

    public function upload(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid PDF uploaded'], 400);
        }

        $file  = $request->file('file');
        $token = Str::uuid()->toString();

        $tempPath = storage_path('app/' . self::TEMP_DIR);
        if (!is_dir($tempPath)) mkdir($tempPath, 0755, true);

        copy($file->getRealPath(), $tempPath . '/' . $token . '.pdf');

        $tokens = session('editor_tokens', []);
        $tokens[$token] = ['name' => $file->getClientOriginalName(), 'ts' => now()->timestamp];
        if (count($tokens) > 5) $tokens = array_slice($tokens, -5, 5, true);
        session(['editor_tokens' => $tokens]);

        return response()->json([
            'token' => $token,
            'name'  => $file->getClientOriginalName(),
            'size'  => $file->getSize(),
        ]);
    }

    public function serveFile(string $token)
    {
        $tokens = session('editor_tokens', []);
        if (!isset($tokens[$token])) abort(403);

        $path = storage_path('app/' . self::TEMP_DIR . '/' . $token . '.pdf');
        if (!file_exists($path)) abort(404);

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }

    public function show(Request $request)
    {
        $token    = $request->query('token', '');
        $fileName = 'document.pdf';

        if ($token) {
            $tokens   = session('editor_tokens', []);
            $fileName = $tokens[$token]['name'] ?? 'document.pdf';
        }

        return view('editor', compact('token', 'fileName'));
    }
}
