<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrawlerService
{
    /**
     * Fetch content from a URL and extract useful text.
     */
    public function crawl(string $url): string
    {
        try {
            $response = Http::timeout(30)->get($url);

            if (!$response->successful()) {
                throw new \Exception("Could not fetch URL: " . $response->status());
            }

            $html = $response->body();
            return $this->extractText($html);
        } catch (\Exception $e) {
            Log::error("Crawling error for {$url}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Basic text extraction from HTML.
     * Removes scripts, styles, and extracts body text.
     */
    protected function extractText(string $html): string
    {
        // Remove script and style tags
        $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $html);
        $html = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $html);
        
        // Strip tags
        $text = strip_tags($html);
        
        // Decode entities
        $text = html_entity_decode($text);
        
        // Remove excessive whitespace
        $text = preg_replace('/\s+/', ' ', $text);
        
        return trim($text);
    }

    /**
     * Simple Sitemap crawler (Basic XML parsing)
     */
    public function getUrlsFromSitemap(string $sitemapUrl): array
    {
        try {
            $response = Http::get($sitemapUrl);
            if (!$response->successful()) return [];

            $xml = simplexml_load_string($response->body());
            $urls = [];

            if ($xml) {
                foreach ($xml->url as $url) {
                    $urls[] = (string) $url->loc;
                }
                // Handle sitemap index
                foreach ($xml->sitemap as $sitemap) {
                    $childUrls = $this->getUrlsFromSitemap((string) $sitemap->loc);
                    $urls = array_merge($urls, $childUrls);
                }
            }

            return array_unique($urls);
        } catch (\Exception $e) {
            Log::error("Sitemap error: " . $e->getMessage());
            return [];
        }
    }
}
