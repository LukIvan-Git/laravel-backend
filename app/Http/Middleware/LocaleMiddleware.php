<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = config('lang.available', ['en']);
        $defaultLocale = config('lang.default', 'en');
        
        // Get locale from URL segment
        $locale = $this->getLocaleFromUrl($request);
        
        // If no locale in URL or invalid locale, redirect to default
        if (!$locale || !in_array($locale, $availableLocales)) {
            return $this->redirectToDefault($request, $defaultLocale);
        }
        
        // Set application locale
        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);
        return $next($request);
    }
    
    /**
     * Extract locale from URL segment
     */
    protected function getLocaleFromUrl(Request $request): ?string
    {
        $segments = $request->segments();
        return $segments[0] ?? null;
    }
    
    /**
     * Redirect to default locale
     */
    protected function redirectToDefault(Request $request, string $defaultLocale)
    {
        $path = $request->path();
        $segments = $request->segments();
        
        // If first segment is an invalid locale, replace it
        if (!empty($segments) && !in_array($segments[0], config('lang.available'))) {
            $segments[0] = $defaultLocale;
            return redirect()->to(implode('/', $segments));
        }
        
        // If no locale in URL, prepend default locale
        return redirect()->to($defaultLocale . ($path ? '/' . $path : ''));
    }
}