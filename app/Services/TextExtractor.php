<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Smalot\PdfParser\Parser as PdfParser;
use Maatwebsite\Excel\Facades\Excel;

class TextExtractor
{
    /**
     * Extract text from a given file path based on its extension.
     *
     * @param string $filePath
     * @return string
     * @throws Exception
     */
    public function extract(string $filePath): string
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        return match ($extension) {
            'pdf' => $this->extractPdf($filePath),
            'xlsx', 'xls', 'csv' => $this->extractExcel($filePath),
            'txt', 'md' => $this->extractText($filePath),
            'png', 'jpg', 'jpeg', 'webp' => $this->extractImage($filePath),
            default => throw new Exception("Unsupported file type: {$extension}")
        };
    }

    protected function extractImage(string $filePath): string
    {
        try {
            $imageData = base64_encode(file_get_contents($filePath));
            $mimeType = mime_content_type($filePath);
            
            $apiKey = env('GEMINI_API_KEY') ?: env('GOOGLE_API_KEY');
            $model = env('GEMINI_MODEL', 'gemini-2.0-flash');
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $response = \Illuminate\Support\Facades\Http::withoutVerifying()->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "What text is in this image? Please extract all textual content exactly as it appears. If it's a document, preserve the structure as much as possible."],
                            [
                                'inline_data' => [
                                    'mime_type' => $mimeType,
                                    'data' => $imageData
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            if (!$response->successful()) {
                throw new Exception("Gemini OCR Error: " . ($response->json('error.message') ?? 'Unknown error'));
            }

            return $this->sanitize($response->json('candidates.0.content.parts.0.text') ?? "");
        } catch (Exception $e) {
            Log::error("Image OCR Failed: " . $e->getMessage());
            throw $e;
        }
    }

    protected function extractPdf(string $filePath): string
    {
        try {
            $parser = new PdfParser();
            $pdf = $parser->parseFile($filePath);
            return $this->sanitize($pdf->getText());
        } catch (Exception $e) {
            Log::error("PDF Extraction Failed: " . $e->getMessage());
            throw $e;
        }
    }

    protected function extractExcel(string $filePath): string
    {
        try {
            // We'll use a simple array import to get all data
            $data = Excel::toArray([], $filePath);
            
            // Flatten the array and convert to a string
            $text = "";
            foreach ($data as $sheet) {
                foreach ($sheet as $row) {
                    $text .= implode(" ", array_filter($row)) . "\n";
                }
            }
            return $this->sanitize($text);
        } catch (Exception $e) {
            Log::error("Excel Extraction Failed: " . $e->getMessage());
            throw $e;
        }
    }

    protected function extractText(string $filePath): string
    {
        return $this->sanitize(file_get_contents($filePath));
    }

    /**
     * Ensure text is valid UTF-8 to prevent database errors.
     */
    protected function sanitize(string $text): string
    {
        // Remove null bytes
        $text = str_replace("\0", "", $text);
        
        // Force UTF-8 encoding, ignoring invalid characters
        return mb_convert_encoding($text, 'UTF-8', 'UTF-8');
    }
}
