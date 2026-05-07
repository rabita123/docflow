<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ChatController extends SummarizeController
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }

        $path = $this->saveUpload($request->file('file'));
        $text = $this->extractText($path, 20);
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return response()->json(['error' => 'No readable text found.'], 400);
        }

        $sessionId = Str::random(16);

        Cache::put('docflow_chat_' . $sessionId, [
            'text'    => $text,
            'history' => [],
        ], now()->addHour());

        return response()->json(['session_id' => $sessionId]);
    }

    public function chat(Request $request)
    {
        $sessionId = $request->input('session_id');
        $question  = trim($request->input('question', ''));

        if (!$sessionId || !Cache::has('docflow_chat_' . $sessionId)) {
            return response()->json(['error' => 'Session expired. Please upload the PDF again.'], 400);
        }
        if (empty($question)) {
            return response()->json(['error' => 'Question is required.'], 400);
        }

        $session = Cache::get('docflow_chat_' . $sessionId);
        $apiKey  = config('anthropic.api_key') ?: env('ANTHROPIC_API_KEY');

        if (empty($apiKey)) {
            return response()->json(['error' => 'ANTHROPIC_API_KEY not set in .env file'], 500);
        }

        $system  = "You are a helpful document assistant. Answer questions ONLY based on the document below.\n"
            . "If the answer isn't in the document, say so clearly. Be concise.\n\n"
            . "DOCUMENT:\n" . $session['text'];

        $history   = $session['history'];
        $history[] = ['role' => 'user', 'content' => $question];

        try {
            $ch = curl_init('https://api.anthropic.com/v1/messages');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_HTTPHEADER     => [
                    'x-api-key: ' . $apiKey,
                    'anthropic-version: 2023-06-01',
                    'content-type: application/json',
                ],
                CURLOPT_POSTFIELDS => json_encode([
                    'model'      => $this->model,
                    'max_tokens' => 600,
                    'system'     => $system,
                    'messages'   => $history,
                ]),
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                $err = json_decode($response, true);
                return response()->json(['error' => $err['error']['message'] ?? 'API error'], 500);
            }

            $data   = json_decode($response, true);
            $answer = $data['content'][0]['text'] ?? '';

            $history[]           = ['role' => 'assistant', 'content' => $answer];
            $session['history']  = array_slice($history, -20);
            Cache::put('docflow_chat_' . $sessionId, $session, now()->addHour());

            return response()->json(['answer' => $answer]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
