<?php

namespace App\Http\Controllers;

use App\Models\Request as CodeRequest;
use App\Models\AppModel as AiModel; // ÇAKIŞMA ÇÖZÜLDÜ: Model'e alias verdik
use App\Models\ModelOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{
    public function analyze(Request $request)
    {
        $request->validate([
            'language' => 'required|string',
            'request_type' => 'required|string',
            'content' => 'required|string',
            'additional_notes' => 'nullable|string', // Ek notlar validasyonu
        ]);

        // Kullanıcıdan gelen veriler
        $language = $request->input('language');
        $requestType = $request->input('request_type');
        $content = $request->input('content');
        $additionalNotes = $request->input('additional_notes', ''); // Ek notlar

        // 1- Kullanıcı isteğini kaydet
        $codeRequest = CodeRequest::create([
            'user_id' => Auth::id(),
            'language' => $language,
            'request_type' => $requestType,
            'content' => $content,
            'additional_notes' => $additionalNotes, // Ek notları kaydet
        ]);

        // 2- Kullanılacak Modelleri Getir
        $models = AiModel::all();

        $outputs = [];

        foreach ($models as $model) {
            $outputContent = '';

            if ($model->provider == 'OpenAI') {
                $outputContent = $this->analyzeWithOpenAI($content, $requestType, $language, $additionalNotes);
            } elseif ($model->provider == 'Google') {
                $outputContent = $this->analyzeWithGemini($content, $requestType, $language, $additionalNotes);
            } elseif ($model->provider == 'Meta') {
                $outputContent = "Meta LLaMA dummy response (Henüz gerçek API eklenmedi)";
            }

            // 3- Model çıktısını kaydet
            $modelOutput = ModelOutput::create([
                'request_id' => $codeRequest->id,
                'model_id' => $model->id,
                'output_content' => $outputContent,
            ]);

            // 4- Çıkışı array formatında düzenliyoruz
            $outputs[] = [
                'id' => $modelOutput->id,
                'model_id' => $model->id,
                'model_name' => $model->name,
                'provider' => $model->provider, // <-- bunu da ekle
                'output_content' => $outputContent,
            ];

        }

        return response()->json([
            'message' => 'Kod analiz edildi.',
            'outputs' => $outputs,
        ]);
    }

    private function analyzeWithOpenAI($content, $requestType, $language, $additionalNotes = '')
    {
        try {
            $apiKey = env('OPENAI_API_KEY');

            // İstek içeriğini hazırla
            $requestContent = "Dil: $language\n\n";
            $requestContent .= "Kod:\n$content\n\n";
            $requestContent .= "İstek: $requestType";

            // Eğer ek notlar varsa ekle
            if (!empty($additionalNotes)) {
                $requestContent .= "\n\nEk Talimatlar: $additionalNotes";
            }

            $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'Sen bir kod yorumcususun.'],
                    ['role' => 'user', 'content' => $requestContent],
                ],
                'temperature' => 0.5,
            ]);

            if ($response->successful()) {
                return $response->json()['choices'][0]['message']['content'] ?? 'OpenAI boş cevap döndü.';
            } else {
                return 'OpenAI Hata: ' . $response->body();
            }

        } catch (\Exception $e) {
            return 'OpenAI İstisna: ' . $e->getMessage();
        }
    }

    private function analyzeWithGemini($content, $requestType, $language, $additionalNotes = '')
    {
        try {
            $apiKey = env('GEMINI_API_KEY');

            // İstek içeriğini hazırla
            $requestContent = "Dil: $language\n\n";
            $requestContent .= "Kod:\n$content\n\n";
            $requestContent .= "İstek: $requestType";

            // Eğer ek notlar varsa ekle
            if (!empty($additionalNotes)) {
                $requestContent .= "\n\nEk Talimatlar: $additionalNotes";
            }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $requestContent]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Gemini boş cevap döndü.';
            } else {
                return 'Gemini Hata: ' . $response->body();
            }

        } catch (\Exception $e) {
            return 'Gemini İstisna: ' . $e->getMessage();
        }
    }
}
