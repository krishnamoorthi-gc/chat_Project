<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for 'lang' parameter in request, otherwise check session
        $locale = $request->get('lang', session('locale', config('app.locale')));

        // Basic validation for locale string (letters, hyphens, underscores)
        if (preg_match('/^[a-zA-Z0-9_\-]+$/', $locale)) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }

        return $next($request);
    }
}
