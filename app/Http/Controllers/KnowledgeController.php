<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    public function upload(
        Request $request, 
        \App\Services\TextExtractor $extractor,
        \App\Services\ChunkingService $chunker,
        \App\Services\EmbeddingService $embedder
    ) {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:pdf,xlsx,csv,txt,md,png,jpg,jpeg,webp|max:10240', // 10MB max
            'chatbot_id' => 'required|exists:chatbots,id',
        ]);

        $chatbot = \App\Models\Chatbot::findOrFail($request->chatbot_id);
        $uploadedSources = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store('knowledge_base', 'public');
            
            $source = $chatbot->knowledgeSources()->create([
                'type' => 'file',
                'title' => $file->getClientOriginalName(),
                'file_path' => $path,
                'status' => 'processing',
            ]);

            try {
                $text = $extractor->extract(storage_path('app/public/' . $path));
                $this->processSource($source, $text, $chunker, $embedder);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Extraction failed for source {$source->id}: " . $e->getMessage());
                $source->update([
                    'status' => 'failed',
                    'error_message' => "Extraction failed: " . $e->getMessage()
                ]);
            }

            $uploadedSources[] = $source;
        }

        return response()->json([
            'message' => 'Files uploaded and processing',
            'sources' => $uploadedSources
        ]);
    }

    public function crawl(
        Request $request,
        \App\Services\CrawlerService $crawler,
        \App\Services\ChunkingService $chunker,
        \App\Services\EmbeddingService $embedder
    ) {
        $request->validate([
            'chatbot_id' => 'required|exists:chatbots,id',
            'url' => 'required|url',
            'is_sitemap' => 'boolean'
        ]);

        $chatbot = \App\Models\Chatbot::findOrFail($request->chatbot_id);
        $urls = $request->is_sitemap ? $crawler->getUrlsFromSitemap($request->url) : [$request->url];
        
        // Limit to prevent accidental overload for MVP
        $urls = array_slice($urls, 0, 10);
        $createdSources = [];

        foreach ($urls as $url) {
            $source = $chatbot->knowledgeSources()->create([
                'type' => 'url',
                'title' => $url,
                'status' => 'processing',
            ]);

            try {
                $content = $crawler->crawl($url);
                $this->processSource($source, $content, $chunker, $embedder);
            } catch (\Exception $e) {
                $source->update(['status' => 'failed', 'error_message' => $e->getMessage()]);
            }
            
            $createdSources[] = $source;
        }

        return response()->json([
            'message' => count($createdSources) . ' links added to queue',
            'sources' => $createdSources
        ]);
    }

    public function storeText(Request $request, \App\Services\ChunkingService $chunker, \App\Services\EmbeddingService $embedder)
    {
        $request->validate([
            'chatbot_id' => 'required|exists:chatbots,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $chatbot = \App\Models\Chatbot::findOrFail($request->chatbot_id);
        
        $source = $chatbot->knowledgeSources()->create([
            'type' => 'text',
            'title' => $request->title,
            'status' => 'processing',
        ]);

        $this->processSource($source, $request->content, $chunker, $embedder);

        return response()->json(['message' => 'Text stored and processed', 'source' => $source]);
    }

    public function storeQA(Request $request, \App\Services\ChunkingService $chunker, \App\Services\EmbeddingService $embedder)
    {
        $request->validate([
            'chatbot_id' => 'required|exists:chatbots,id',
            'qa_pairs' => 'required|array|min:1',
            'qa_pairs.*.q' => 'required|string',
            'qa_pairs.*.a' => 'required|string',
        ]);

        $chatbot = \App\Models\Chatbot::findOrFail($request->chatbot_id);
        
        $content = "";
        foreach($request->qa_pairs as $pair) {
            $content .= "Question: " . $pair['q'] . "\nAnswer: " . $pair['a'] . "\n\n";
        }

        $source = $chatbot->knowledgeSources()->create([
            'type' => 'qa',
            'title' => 'Q&A Set - ' . now()->format('M d, H:i'),
            'status' => 'processing',
        ]);

        $this->processSource($source, $content, $chunker, $embedder);

        return response()->json(['message' => 'Q&A pairs stored and processed', 'source' => $source]);
    }

    protected function processSource($source, $text, $chunker, $embedder)
    {
        try {
            $source->update(['content' => $text]);
            $chatbot = $source->chatbot;
            $responseMode = $chatbot->settings['response_mode'] ?? 'ai';

            // 2. Chunk Text
            $chunks = $chunker->chunk($text);

            // 3. Store Chunks
            foreach ($chunks as $index => $chunkText) {
                $vector = null;

                // Only call Gemini if in AI mode. If in Direct mode, we skip to avoid rate limits.
                if ($responseMode === 'ai') {
                    try {
                        $vector = $embedder->getEmbedding($chunkText);
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::warning("Embedding failed for chunk {$index} of source {$source->id}, stored as text-only: " . $e->getMessage());
                        // We continue so the data is at least searchable via keywords
                    }
                }

                $source->chunks()->create([
                    'chunk_text' => $chunkText,
                    'embedding' => $vector, 
                    'chunk_index' => $index,
                ]);
            }
            
            $source->update(['status' => 'processed', 'error_message' => null]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Processing failed for source {$source->id}: " . $e->getMessage());
            $source->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);
        }
    }
    public function destroy(\App\Models\KnowledgeSource $knowledgeSource)
    {
        // Ensure user owns the chatbot this source belongs to
        if ($knowledgeSource->chatbot->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete valid file from storage if it exists
        if ($knowledgeSource->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($knowledgeSource->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($knowledgeSource->file_path);
        }

        $knowledgeSource->delete();

        return back()->with('success', 'Knowledge source deleted successfully.');
    }

    public function retry(
        \App\Models\KnowledgeSource $source,
        \App\Services\TextExtractor $extractor,
        \App\Services\ChunkingService $chunker,
        \App\Services\EmbeddingService $embedder,
        \App\Services\CrawlerService $crawler
    ) {
        if ($source->chatbot->user_id !== auth()->id()) {
            abort(403);
        }

        $source->update(['status' => 'processing', 'error_message' => null]);
        
        // Clear old chunks if any
        $source->chunks()->delete();

        try {
            if ($source->type === 'file') {
                $text = $extractor->extract(storage_path('app/public/' . $source->file_path));
                $this->processSource($source, $text, $chunker, $embedder);
            } elseif ($source->type === 'url') {
                $text = $crawler->crawl($source->title);
                $this->processSource($source, $text, $chunker, $embedder);
            } elseif ($source->type === 'text' || $source->type === 'qa') {
                // For text/qa, the content is already in the database
                $this->processSource($source, $source->content, $chunker, $embedder);
            }
            
            return back()->with('success', 'Source is being re-processed.');
        } catch (\Exception $e) {
            $source->update(['status' => 'failed', 'error_message' => $e->getMessage()]);
            return back()->with('error', 'Retry failed: ' . $e->getMessage());
        }
    }
}
