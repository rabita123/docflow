<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TranslateController extends SummarizeController
{
    public function handle(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }

        $path     = $this->saveUpload($request->file('file'));
        $language = $request->input('language', 'Bengali');
        $text     = $this->extractText($path, 10);
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return response()->json(['error' => 'No readable text found.'], 400);
        }

        $prompt = "Translate the following document text to {$language}.\n"
            . "Preserve paragraph structure. Output ONLY the translated text, nothing else.\n\n"
            . "TEXT:\n{$text}";

        try {
            $translated = $this->claude($prompt, 3000);
            $filename   = 'translated_' . strtolower($language) . '.txt';

            return response($translated, 200, [
                'Content-Type'        => 'text/plain; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'AI error: ' . $e->getMessage()], 500);
        }
    }
}
