<?php

namespace App\Services;

class ChunkingService
{
    /**
     * Split text into chunks of a approximate size.
     * Simple character-based chunking for MVP.
     */
    public function chunk(string $text, int $chunkSize = 1000, int $overlap = 200): array
    {
        $text = $this->cleanText($text);
        if (strlen($text) <= $chunkSize) {
            return [$text];
        }

        $chunks = [];
        $length = strlen($text);
        $start = 0;

        while ($start < $length) {
            $end = $start + $chunkSize;
            
            // If we are not at the end, try to find a sentence break to avoid cutting words
            if ($end < $length) {
                // Look for period, newline, or space in the last 10% of the chunk
                $searchRange = substr($text, $end - 100, 100);
                $breakPos = $this->findBreakPosition($searchRange);
                
                if ($breakPos !== false) {
                    $end = $end - 100 + $breakPos + 1;
                }
            }

            $chunks[] = substr($text, $start, $end - $start);
            $start = $end - $overlap;
        }

        return $chunks;
    }

    protected function findBreakPosition(string $text)
    {
        $positions = [
            strrpos($text, ".\n"),
            strrpos($text, ". "),
            strrpos($text, "\n"),
            strrpos($text, " "),
        ];

        return max($positions);
    }

    protected function cleanText($text)
    {
        // Remove excessive newlines and spaces
        return preg_replace('/\s+/', ' ', trim($text));
    }
}
