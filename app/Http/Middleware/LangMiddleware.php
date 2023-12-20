<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('myLocale') &&
            array_key_exists($request->session()->get('myLocale'),config('app.languages'))){
            app()->setLocale($request->session()->get('myLocale')); //til osy zher arkyly ozgered
        }
        else
            app()->setLocale(config('app.locale'));

        return $next($request);
    }
}
