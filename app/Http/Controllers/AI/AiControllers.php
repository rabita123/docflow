<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Anthropic\Laravel\Facades\Anthropic;

/**
 * Base AI Controller
 * Uses anthropic-sdk-php via the anthropic-ai/anthropic-sdk-php package
 */
abstract class BaseAIController extends Controller
{
    protected string $uploadDir;
    protected string $model = 'claude-sonnet-4-20250514';

    public function __construct()
    {
        $this->uploadDir = storage_path('app/pdf_uploads');
        if (!is_dir($this->uploadDir)) mkdir($this->uploadDir, 0755, true);
    }

    protected function saveUpload(\Illuminate\Http\UploadedFile $file): string
    {
        $ext      = $file->getClientOriginalExtension() ?: 'pdf';
        $filename = Str::random(12) . '.' . $ext;
        $file->move($this->uploadDir, $filename);
        return $this->uploadDir . '/' . $filename;
    }

    /** Extract text from PDF using pdftotext system command */
    protected function extractText(string $pdfPath, int $maxPages = 15): string
    {
        $txt = $this->uploadDir . '/' . Str::random(10) . '.txt';
        exec("pdftotext -l {$maxPages} " . escapeshellarg($pdfPath) . " " . escapeshellarg($txt) . " 2>/dev/null");

        if (!file_exists($txt)) {
            // fallback with gs
            exec("gs -sDEVICE=txtwrite -dNOPAUSE -dBATCH -dQUIET -sOutputFile=" . escapeshellarg($txt) . " " . escapeshellarg($pdfPath) . " 2>/dev/null");
        }

        $text = file_exists($txt) ? file_get_contents($txt) : '';
        @unlink($txt);
        return substr(trim($text), 0, 20000); // max 20K chars to API
    }

    protected function err(string $msg, int $code = 400)
    {
        return response()->json(['error' => $msg], $code);
    }

    /** Call Claude API */
    protected function claude(string $prompt, string $system = '', int $maxTokens = 1000): string
    {
        $messages = [['role' => 'user', 'content' => $prompt]];

        $params = [
            'model'      => $this->model,
            'max_tokens' => $maxTokens,
            'messages'   => $messages,
        ];
        if ($system) $params['system'] = $system;

        $response = Anthropic::messages()->create($params);
        return $response->content[0]->text ?? '';
    }
}

// ─────────────────────────────────────────────────────────────────────────────

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;

class SummarizeController extends BaseAIController
{
    public function handle(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return $this->err('No valid file uploaded');
        }

        $path   = $this->saveUpload($request->file('file'));
        $length = $request->input('length', 'medium');
        $text   = $this->extractText($path);
        @unlink($path);

        if (strlen(trim($text)) < 30) {
            return $this->err('No readable text found in PDF. Try OCR first.');
        }

        $words = ['short' => '150 words', 'medium' => '350 words', 'detailed' => '700 words'];
        $target = $words[$length] ?? '350 words';

        $prompt = <<<PROMPT
Summarize the following document in exactly {$target}.

Structure your response as:
**Overview:** (2-3 sentences)
**Key Points:**
- Point 1
- Point 2
- Point 3
**Conclusion:** (1-2 sentences)

Document:
{$text}
PROMPT;

        try {
            $summary = $this->claude($prompt, '', 1000);
            return response()->json(['summary' => $summary]);
        } catch (\Exception $e) {
            return $this->err('AI error: ' . $e->getMessage());
        }
    }
}

// ─────────────────────────────────────────────────────────────────────────────

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChatController extends BaseAIController
{
    /** Upload PDF and create chat session */
    public function upload(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return $this->err('No valid file uploaded');
        }

        $path = $this->saveUpload($request->file('file'));
        $text = $this->extractText($path, 20);
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return $this->err('No readable text found. Try OCR first.');
        }

        $sessionId = Str::random(16);

        // Store in cache for 1 hour
        Cache::put("docflow_chat_{$sessionId}", [
            'text'    => $text,
            'history' => [],
        ], now()->addHour());

        return response()->json([
            'session_id' => $sessionId,
            'chars'      => strlen($text),
        ]);
    }

    /** Answer a question about the uploaded PDF */
    public function chat(Request $request)
    {
        $sessionId = $request->input('session_id');
        $question  = trim($request->input('question', ''));

        if (!$sessionId || !Cache::has("docflow_chat_{$sessionId}")) {
            return $this->err('Session expired. Please upload the PDF again.');
        }
        if (empty($question)) {
            return $this->err('Question is required.');
        }

        $session = Cache::get("docflow_chat_{$sessionId}");
        $system  = "You are a helpful document assistant. Answer questions ONLY based on the document content below.
If the answer isn't in the document, say so clearly.
Be concise and cite page numbers when possible.

DOCUMENT CONTENT:
{$session['text']}";

        // Build conversation history
        $history   = $session['history'];
        $history[] = ['role' => 'user', 'content' => $question];

        try {
            $response = \Anthropic\Laravel\Facades\Anthropic::messages()->create([
                'model'      => $this->model,
                'max_tokens' => 600,
                'system'     => $system,
                'messages'   => $history,
            ]);
            $answer = $response->content[0]->text ?? '';

            // Update history
            $history[]           = ['role' => 'assistant', 'content' => $answer];
            $session['history']  = array_slice($history, -20); // keep last 20
            Cache::put("docflow_chat_{$sessionId}", $session, now()->addHour());

            return response()->json(['answer' => $answer]);
        } catch (\Exception $e) {
            return $this->err('AI error: ' . $e->getMessage());
        }
    }
}

// ─────────────────────────────────────────────────────────────────────────────

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;

class TranslateController extends BaseAIController
{
    public function handle(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return $this->err('No valid file uploaded');
        }

        $path     = $this->saveUpload($request->file('file'));
        $language = $request->input('language', 'Bengali');
        $text     = $this->extractText($path, 10);
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return $this->err('No readable text found.');
        }

        $prompt = "Translate the following document text to {$language}. 
Preserve paragraph structure and formatting.
Output ONLY the translated text, nothing else.

TEXT:
{$text}";

        try {
            $translated = $this->claude($prompt, '', 3000);

            // Return as downloadable text file
            $filename = 'translated_' . strtolower($language) . '.txt';
            return response($translated, 200, [
                'Content-Type'        => 'text/plain; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        } catch (\Exception $e) {
            return $this->err('AI error: ' . $e->getMessage());
        }
    }
}

// ─────────────────────────────────────────────────────────────────────────────

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;

class ExtractDataController extends BaseAIController
{
    public function handle(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return $this->err('No valid file uploaded');
        }

        $path     = $this->saveUpload($request->file('file'));
        $dataType = $request->input('type', 'invoice');
        $text     = $this->extractText($path, 10);
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return $this->err('No readable text found.');
        }

        $instructions = [
            'invoice' => 'Extract all invoice data: invoice_number, date, vendor_name, items (array with name, qty, unit_price), subtotal, tax, total. Return JSON array of invoices.',
            'table'   => 'Extract all tabular/grid data. Return JSON with "headers" (array of strings) and "rows" (array of arrays).',
            'contact' => 'Extract all contact information: name, email, phone, company, address. Return JSON array of contacts.',
        ];

        $instruction = $instructions[$dataType] ?? $instructions['invoice'];
        $prompt = "{$instruction}\n\nReturn ONLY valid JSON. No markdown. No explanation.\n\nDOCUMENT:\n{$text}";

        try {
            $raw = $this->claude($prompt, '', 2000);

            // Clean any markdown fences
            $clean = preg_replace('/^```(json)?\s*/m', '', $raw);
            $clean = preg_replace('/\s*```$/m', '', $clean);
            $clean = trim($clean);

            // Validate JSON
            $parsed = json_decode($clean, true);
            $output = $parsed ? json_encode($parsed, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $clean;

            $filename = "extracted_{$dataType}.json";
            return response($output, 200, [
                'Content-Type'        => 'application/json; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        } catch (\Exception $e) {
            return $this->err('AI error: ' . $e->getMessage());
        }
    }
}
