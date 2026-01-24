<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class EmbeddingService
{
    /**
     * Generate an embedding vector for the given text using Google Gemini.
     */
    public function getEmbedding(string $text): array
    {
        try {
            $apiKey = env('GEMINI_API_KEY');
            // Gemini embedding model
            $model = 'text-embedding-004';
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:embedContent?key={$apiKey}";

            $response = Http::post($url, [
                'model' => "models/{$model}",
                'content' => [
                    'parts' => [
                        ['text' => $text]
                    ]
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception("Gemini Embedding Error: " . ($response->json('error.message') ?? 'Unknown error'));
            }

            return $response->json('values') ?? [];
        } catch (\Exception $e) {
            Log::error("Gemini Embedding Exception: " . $e->getMessage());
            throw $e;
        }
    }
}
