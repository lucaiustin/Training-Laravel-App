<?php

namespace App\Http\Middleware;

use Closure;

class Auth
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
        if (!$request->session()->has('username')) {
            if ($request->ajax()) {
                return response()->json(['errors'=>'Login Error'], 401);
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
