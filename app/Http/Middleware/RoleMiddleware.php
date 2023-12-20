<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $rolename)
    {
        if (Auth::check()){
            if (Auth::user()->role->name == "admin")
                return $next($request);
        }
        else{
            return redirect()->route('login.form');
        }

        return response()->view('errors.noperm');
    }
}
