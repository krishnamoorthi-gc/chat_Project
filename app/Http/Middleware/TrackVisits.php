<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin*') && !$request->expectsJson() && $request->isMethod('get')) {
            try {
                \App\Models\LandingPageVisit::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referrer' => $request->headers->get('referer'),
                    'page_url' => $request->fullUrl(),
                ]);
            } catch (\Exception $e) {
                // Silently fail to not interrupt user experience
                \Log::error('Failed to track visit: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}
