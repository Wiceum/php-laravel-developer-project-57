<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

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
        if (!isEmpty($request->getLanguages()))
        {
            $locale = $this->extractLocale($request);
            if (in_array($locale, config('app.locales'))) {
                app()->setLocale($locale);
            } else {
                app()->setLocale('ru');
            }
        }
        return $next($request);
    }

    private function extractLocale(Request $request)
    {
        $languages = $request->getLanguages();
        return $languages[0];
    }
}
