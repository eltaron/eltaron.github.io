<?php

namespace App\Http\Middleware;

use Closure;

class LangAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->header('Accept-Language')) {
            app()->setLocale(request()->header('Accept-Language'));
        }else{
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
