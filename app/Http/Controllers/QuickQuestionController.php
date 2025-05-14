<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuickQuestionController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $apiKey = env('GEMINI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->input('question')]
                    ]
                ]
            ]
        ]);

        $answer = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Cevap alınamadı.';

        return response()->json([
            'answer' => $answer
        ]);
    }
}
