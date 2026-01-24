<?php

namespace App\Services;

use App\Models\KnowledgeChunk;
use Illuminate\Support\Collection;

class VectorSearchService
{
    /**
     * Find the most similar chunks to the query string or vector.
     */
    public function search(int $chatbotId, string $queryText, ?array $queryVector = null, int $limit = 4): Collection
    {
        // 1. Fetch all chunks for this chatbot
        $chunks = KnowledgeChunk::whereHas('source', function ($query) use ($chatbotId) {
            $query->where('chatbot_id', $chatbotId)
                  ->where('status', 'processed');
        })->get(['id', 'chunk_text', 'embedding', 'knowledge_source_id']);

        if ($chunks->isEmpty()) {
            return collect([]);
        }

        // 2. Calculate Similarity
        $scoredChunks = $chunks->map(function ($chunk) use ($queryVector, $queryText) {
            $similarity = 0;

            if ($queryVector && $chunk->embedding) {
                // Use Vector similarity if both are available
                $similarity = $this->cosineSimilarity($queryVector, $chunk->embedding);
            } else {
                // Fallback: Simple Keyword Overlap (Zero-AI approach)
                $similarity = $this->keywordOverlap($queryText, $chunk->chunk_text);
            }

            $chunk->similarity = $similarity;
            return $chunk;
        });

        // 3. Sort by similarity (descending) and take top N
        return $scoredChunks->sortByDesc('similarity')
            ->filter(fn($c) => $c->similarity > 0) // Only return relevant matches
            ->take($limit)
            ->load('source'); // Ensure source is loaded for title display
    }

    private function keywordOverlap(string $query, string $text): float
    {
        $queryWords = array_unique(explode(' ', strtolower(preg_replace('/[^a-z0-9 ]/', '', $query))));
        $textWords = array_unique(explode(' ', strtolower(preg_replace('/[^a-z0-9 ]/', '', $text))));
        
        $matches = array_intersect($queryWords, $textWords);
        
        if (count($queryWords) === 0) return 0;
        
        // Return percentage of query words found in text
        return count($matches) / count($queryWords);
    }

    private function cosineSimilarity(array $vecA, array $vecB): float
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        foreach ($vecA as $i => $valA) {
            $valB = $vecB[$i] ?? 0;
            $dotProduct += $valA * $valB;
            $normA += $valA * $valA;
            $normB += $valB * $valB;
        }

        $normA = sqrt($normA);
        $normB = sqrt($normB);

        if ($normA == 0 || $normB == 0) {
            return 0;
        }

        return $dotProduct / ($normA * $normB);
    }
}
