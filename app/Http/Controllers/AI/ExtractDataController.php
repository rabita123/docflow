<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;

class ExtractDataController extends SummarizeController
{
    public function handle(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }

        $path     = $this->saveUpload($request->file('file'));
        $dataType = $request->input('type', 'invoice');
        $text     = $this->extractText($path, 10);
        @unlink($path);

        if (strlen(trim($text)) < 20) {
            return response()->json(['error' => 'No readable text found.'], 400);
        }

        $instructions = [
            'invoice' => 'Extract all invoice data: invoice_number, date, vendor_name, items (array with name, qty, unit_price), subtotal, tax, total. Return JSON array.',
            'table'   => 'Extract all tabular data. Return JSON with "headers" array and "rows" array of arrays.',
            'contact' => 'Extract all contacts: name, email, phone, company, address. Return JSON array.',
        ];

        $instruction = $instructions[$dataType] ?? $instructions['invoice'];
        $prompt      = $instruction . "\n\nReturn ONLY valid JSON. No markdown. No explanation.\n\nDOCUMENT:\n{$text}";

        try {
            $raw   = $this->claude($prompt, 2000);
            $clean = trim(preg_replace('/^```(json)?\s*|\s*```$/m', '', $raw));

            $parsed = json_decode($clean, true);
            $output = $parsed
                ? json_encode($parsed, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                : $clean;

            return response($output, 200, [
                'Content-Type'        => 'application/json; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="extracted_' . $dataType . '.json"',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'AI error: ' . $e->getMessage()], 500);
        }
    }
}
