<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CodeRunController extends Controller
{
    public function run(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:5000',
        ]);

        $apiKey = env('GEMINI_API_KEY');

        $prompt = 'Execute the code provided below.

Only the direct result of the code execution should be displayed.

Ensure the output is clear and well-structured with proper line breaks for better readability.

Add bold formatting where appropriate to highlight key results.

Avoid any additional explanations, error handling, or comments.

Code to execute::' . "\n\n" . $request->input('code');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

        $result = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Kod yanıtı alınamadı.';

        return response()->json([
            'result' => $result
        ]);
    }
}
