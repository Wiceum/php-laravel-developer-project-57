<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->extractLocale($request);
        if ($locale === 'en') {
                app()->setLocale($locale);
        } else {
            app()->setLocale('ru');
        }
        return $next($request);
    }

    private function extractLocale(Request $request)
    {
        $languages = $request->getLanguages();
        return $languages[0];
    }
}
