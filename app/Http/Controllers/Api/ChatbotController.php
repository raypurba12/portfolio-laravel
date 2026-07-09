<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $message = $request->input('message');
        $apiKey = config('services.openrouter.api_key');
        $siteUrl = config('app.url');
        $siteName = config('app.name');

        if (!$apiKey || trim($apiKey) === '') {
            return response()->json([
                'reply' => null,
                'source' => 'no_key',
            ]);
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'X-Title' => $siteName,
                    'HTTP-Referer' => $siteUrl,
                ])
                ->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'openai/gpt-4o-mini',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Kamu adalah asisten portofolio pribadi. Jawab pertanyaan tentang skills, projects, pengalaman, edukasi, dan kontak secara ramah dan profesional dalam bahasa Indonesia. Jawab singkat maksimal 3 kalimat. Jangan menyebut bahwa kamu adalah AI atau model bahasa.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $message,
                        ],
                    ],
                    'max_tokens' => 200,
                ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['choices'][0]['message']['content'])) {
                    return response()->json([
                        'reply' => trim($data['choices'][0]['message']['content']),
                        'source' => 'openrouter',
                    ]);
                }
            }

            $errorMsg = $response->json()['error']['message'] ?? 'Unknown API error';

            return response()->json([
                'reply' => null,
                'source' => 'error',
                'error' => $errorMsg,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'reply' => null,
                'source' => 'error',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
