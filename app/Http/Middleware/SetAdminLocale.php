<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetAdminLocale
{
    private const SUPPORTED = ['es', 'ca'];
    private const DEFAULT = 'es';

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request);

        app()->setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }

    private function resolveLocale(Request $request): string
    {
        // Priority: authenticated user preference → session → default
        if ($request->user()?->locale) {
            return in_array($request->user()->locale, self::SUPPORTED, true)
                ? $request->user()->locale
                : self::DEFAULT;
        }

        $sessionLocale = session('locale');

        return in_array($sessionLocale, self::SUPPORTED, true)
            ? $sessionLocale
            : self::DEFAULT;
    }
}
