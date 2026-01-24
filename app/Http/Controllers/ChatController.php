<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(
        Request $request,
        \App\Services\EmbeddingService $embedder,
        \App\Services\VectorSearchService $searcher
    ) {
        $request->validate([
            'chatbot_id' => 'required|exists:chatbots,id',
            'message' => 'required|string',
        ]);

        $chatbot = \App\Models\Chatbot::findOrFail($request->chatbot_id);
        $userMessage = $request->message;

        try {
            $responseMode = $chatbot->settings['response_mode'] ?? 'ai';
            $queryVector = null;

            // 1. Only use OpenAI for embedding if in AI Mode
            if ($responseMode === 'ai') {
                try {
                    $queryVector = $embedder->getEmbedding($userMessage);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning("Embedding failed, falling back to keyword search: " . $e->getMessage());
                }
            }

            // 2. Find relevant context (Now supports keyword fallback inside the searcher)
            $relevantChunks = $searcher->search($chatbot->id, $userMessage, $queryVector);
            $context = $relevantChunks->pluck('chunk_text')->implode("\n\n---\n\n");

            // --- USER REQUEST: "No need chatgpt ai for text data" ---
            // If response mode is 'direct' or embedding failed and we found matches, return directly.
            if ($responseMode === 'direct' && $relevantChunks->isNotEmpty()) {
                $bestChunk = $relevantChunks->first();
                $answer = $bestChunk->chunk_text;

                // If it's a Q&A pair, extract the Answer part for a cleaner response
                if (stripos($answer, "Question:") !== false && stripos($answer, "Answer:") !== false) {
                    if (preg_match('/Answer:\s*(.*)/is', $answer, $matches)) {
                        $answer = trim($matches[1]);
                    }
                }

                return response()->json([
                    'answer' => $answer,
                    'sources' => [$bestChunk->source->title]
                ]);
            }

            // 3. Prepare System Prompt (AI Enhanced Mode)
            $defaultPrompt = "You are a 'Short & Sweet' AI assistant. Your ONLY job is to extract the most important answer from the dataset context provided. \n" .
                             "STRICT RULES:\n" .
                             "1. NEVER return the full text block or dataset.\n" .
                             "2. Pick only the 1-2 most relevant sentences that answer the user's question.\n" .
                             "3. Be extremely concise. Use bullet points if there are multiple key facts.\n" .
                             "4. If the question is simple, give a one-sentence answer.\n" .
                             "5. Rephrase the data to be friendly and professional.";
            
            $systemPrompt = $chatbot->prompt_template ?: $defaultPrompt;
            
            $fullPrompt = "SYSTEM INSTRUCTIONS:\n{$systemPrompt}\n\nCONTEXT FROM DATASET:\n{$context}\n\nUSER QUESTION: {$userMessage}\n\nREWORKED ANSWER (SHORT & SWEET):";

            // 4. Call Google Gemini
            $apiKey = env('GEMINI_API_KEY');
            $model = env('GEMINI_MODEL', 'gemini-2.0-flash');
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $response = \Illuminate\Support\Facades\Http::post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.5,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception("Gemini API Error: " . ($response->json('error.message') ?? 'Unknown error'));
            }

            $answer = $response->json('candidates.0.content.parts.0.text') ?? "I'm sorry, I couldn't generate a response.";

            return response()->json([
                'answer' => $answer,
                'sources' => $relevantChunks->pluck('source.title')->unique()->values()
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Chat Error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to generate response.'], 500);
        }
    }
}
