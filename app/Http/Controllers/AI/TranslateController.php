<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TranslateController extends SummarizeController
{
    protected string $model = 'claude-haiku-4-5-20251001'; // faster for translation

    public function handle(Request $request)
    {
        set_time_limit(180); // 3 minutes max

        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }

        $path     = $this->saveUpload($request->file('file'));
        $language = $request->input('language', 'Bengali');
        $text     = $this->extractText($path, 5); // max 5 pages
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return response()->json(['error' => 'No readable text found.'], 400);
        }

        // Limit text to 6000 chars to keep response fast
        $text = substr(trim($text), 0, 6000);

        $prompt = "Translate the following text to {$language}. Preserve paragraph structure. Output ONLY the translated text.\n\nTEXT:\n{$text}";

        try {
            $translated = $this->claude($prompt, 2000);

            return response()->json(['translation' => $translated]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'AI error: ' . $e->getMessage()], 500);
        }
    }
}
