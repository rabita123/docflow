<?php

namespace App\Http\Controllers\AI;

use Illuminate\Http\Request;

class FormFillController extends SummarizeController
{
    protected string $model = 'claude-haiku-4-5-20251001';

    public function handle(Request $request)
    {
        $request->validate([
            'field_labels' => 'required|string|max:3000',
            'user_info'    => 'required|string|max:2000',
        ]);

        $fieldLabels = $request->input('field_labels');
        $userInfo    = $request->input('user_info');
        $today       = date('Y-m-d');

        $prompt = <<<PROMPT
You are a form-filling assistant. Fill in a PDF form automatically based on the user's information.

Form fields detected in the PDF:
{$fieldLabels}

User's information:
{$userInfo}

Today's date: {$today}

Instructions:
- Map each form field label to an appropriate value from the user's information.
- For date fields, use a formatted date (e.g. "May 19, 2026" or "2026-05-19").
- For fields you cannot fill from the provided info, use an empty string "".
- Use only the exact field labels as keys in your response.
- Return ONLY a valid JSON object. No explanation, no markdown, no code fences.

Example output:
{"Full Name": "John Doe", "Email": "john@example.com", "Phone": "555-1234", "Date": "May 19, 2026"}
PROMPT;

        try {
            $raw   = $this->claude($prompt, 1500);
            $clean = trim(preg_replace('/^```(json)?\s*|\s*```$/m', '', $raw));
            $fills = json_decode($clean, true) ?: [];
            return response()->json(['fills' => $fills]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
