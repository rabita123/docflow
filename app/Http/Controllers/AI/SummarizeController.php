<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SummarizeController extends Controller
{
    protected string $uploadDir;
    protected string $model = 'claude-sonnet-4-20250514';

    public function __construct()
    {
        $this->uploadDir = storage_path('app/pdf_uploads');
        if (!is_dir($this->uploadDir)) mkdir($this->uploadDir, 0755, true);
    }

    public function handle(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }

        $path   = $this->saveUpload($request->file('file'));
        $length = $request->input('length', 'medium');
        $text   = $this->extractText($path);
        @unlink($path);

        if (strlen(trim($text)) < 30) {
            return response()->json(['error' => 'No readable text found in PDF.'], 400);
        }

        $words  = ['short' => '150 words', 'medium' => '350 words', 'detailed' => '700 words'];
        $target = $words[$length] ?? '350 words';

        $prompt = "Summarize the following document in exactly {$target}.\n\n"
            . "Structure:\n**Overview:** (2-3 sentences)\n**Key Points:**\n- Point 1\n- Point 2\n**Conclusion:** (1-2 sentences)\n\n"
            . "Document:\n{$text}";

        try {
            $answer = $this->claude($prompt, 1000);
            return response()->json(['summary' => $answer]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'AI error: ' . $e->getMessage()], 500);
        }
    }

    protected function saveUpload(\Illuminate\Http\UploadedFile $file): string
    {
        $ext      = $file->getClientOriginalExtension() ?: 'pdf';
        $filename = Str::random(12) . '.' . $ext;
        $file->move($this->uploadDir, $filename);
        return $this->uploadDir . DIRECTORY_SEPARATOR . $filename;
    }

    protected function extractText(string $path, int $maxPages = 15): string
    {
        $txt = storage_path('app/pdf_outputs/' . Str::random(10) . '.txt');
        if (!is_dir(dirname($txt))) mkdir(dirname($txt), 0755, true);

        $pdftotext = $this->getPdftotextCmd();
        exec($pdftotext . ' -l ' . $maxPages . ' ' . escapeshellarg($path) . ' ' . escapeshellarg($txt) . ' 2>&1');

        $text = file_exists($txt) ? file_get_contents($txt) : '';
        @unlink($txt);
        return substr(trim($text), 0, 20000);
    }

  protected function getPdftotextCmd(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            foreach (['C:\\poppler\\Library\\bin\\pdftotext.exe', 'C:\\poppler\\bin\\pdftotext.exe'] as $p) {
                if (file_exists($p)) return '"' . $p . '"';
            }
        }
        return 'pdftotext';
    }

    protected function claude(string $prompt, int $maxTokens = 1000): string
    {
        $apiKey = config('anthropic.api_key') ?: env('ANTHROPIC_API_KEY');

        if (empty($apiKey)) {
            throw new \Exception('ANTHROPIC_API_KEY not set in .env file');
        }

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
                'max_tokens' => $maxTokens,
                'messages'   => [['role' => 'user', 'content' => $prompt]],
            ]),
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            $err = json_decode($response, true);
            throw new \Exception($err['error']['message'] ?? 'API error ' . $httpCode);
        }

        $data = json_decode($response, true);
        return $data['content'][0]['text'] ?? '';
    }
}
