<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user_id', Auth::id())->latest()->get();
        return view('chat.index', compact('chats'));
    }


    public function start(Request $request)
    {
        $request->validate([
            'models' => 'required|array|min:1',
            'title' => 'nullable|string|max:100',
        ]);

        $title = $request->input('title') ?? 'Yeni Sohbet ' . now()->format('d.m.Y H:i');

        $chat = Chat::create([
            'user_id' => Auth::id(),
            'models' => $request->input('models'),
            'title' => $title,
        ]);

        return redirect()->route('chat.show', $chat->id);
    }



    public function show($id)
    {
        $chat = Chat::with('messages')->where('user_id', Auth::id())->findOrFail($id);
        $chats = Chat::where('user_id', Auth::id())->latest()->get();
        return view('chat.show', compact('chat', 'chats'));
    }

    public function sendMessage(Request $request, $id)
    {
        $chat = Chat::where('user_id', Auth::id())->findOrFail($id);

        if ($request->expectsJson()) {
            $data = $request->json()->all();
            $content = $data['content'] ?? null;
        } else {
            $content = $request->input('content');
        }

        if (!$content) {
            Log::error('Gönderilen content boş!');
            if ($request->expectsJson()) {
                return response()->json(['error' => 'İçerik boş!'], 400);
            }
            return back()->withErrors('İçerik boş!');
        }

        // Kullanıcının mesajını kaydet
        Message::create([
            'chat_id' => $chat->id,
            'sender' => 'user',
            'content' => $content,
        ]);

        // Tüm sohbet geçmişini alıp mesajları oluştur
        $messages = $chat->messages()->orderBy('created_at')->get();

        // Her model için API çağrısı yap ve cevap kaydet
        foreach ($chat->models as $model) {
            $answer = $this->askModelWithHistory($model, $content, $messages);

            Message::create([
                'chat_id' => $chat->id,
                'sender' => 'model',
                'model_name' => strtoupper($model),
                'content' => $answer ?? 'Cevap alınamadı.',
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('chat.show', ['id' => $chat->id]);
    }

    private function askModel($model, $prompt)
    {
        try {
            if ($model == 'openai') {
                $apiKey = env('OPENAI_API_KEY');

                $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.7,
                ]);

                return $response->json()['choices'][0]['message']['content'] ?? 'OpenAI yanıtı alınamadı.';
            }

            if ($model == 'gemini') {
                $apiKey = env('GEMINI_API_KEY');

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

                return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Gemini yanıtı alınamadı.';
            }

            return 'Model desteklenmiyor.';
        } catch (\Exception $e) {
            Log::error('Model yanıt hatası: ' . $e->getMessage());
            return 'Model yanıt verirken bir hata oluştu.';
        }
    }

    private function askModelWithHistory($model, $prompt, $messages)
    {
        try {
            // Geçmiş mesajlardan API istekleri için mesaj dizisi oluştur
            $messageHistory = [];

            foreach ($messages as $message) {
                if ($message->sender === 'user') {
                    $messageHistory[] = ['role' => 'user', 'content' => $message->content];
                } elseif ($message->sender === 'model' && strtoupper($message->model_name) === strtoupper($model)) {
                    $messageHistory[] = ['role' => 'assistant', 'content' => $message->content];
                }
            }

            if ($model == 'openai') {
                $apiKey = env('OPENAI_API_KEY');

                $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4',
                    'messages' => $messageHistory,
                    'temperature' => 0.7,
                ]);

                return $response->json()['choices'][0]['message']['content'] ?? 'OpenAI yanıtı alınamadı.';
            }

            if ($model == 'gemini') {
                $apiKey = env('GEMINI_API_KEY');

                // Gemini'nin farklı bir formata ihtiyacı var, mesajları birleştirip gönderelim
                $conversationText = "";
                foreach ($messageHistory as $msg) {
                    $role = $msg['role'] === 'user' ? 'Kullanıcı: ' : 'Asistan: ';
                    $conversationText .= $role . $msg['content'] . "\n\n";
                }

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json'
                ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey", [
                        'contents' => [
                            [
                                'parts' => [
                                    ['text' => $conversationText]
                                ]
                            ]
                        ]
                    ]);

                return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Gemini yanıtı alınamadı.';
            }

            return 'Model desteklenmiyor.';
        } catch (\Exception $e) {
            Log::error('Model yanıt hatası: ' . $e->getMessage());
            return 'Model yanıt verirken bir hata oluştu.';
        }
    }

    public function delete($id)
    {
        $chat = Chat::where('user_id', Auth::id())->findOrFail($id);
        $chat->delete();

        return redirect()->route('chat.index');
    }
}
