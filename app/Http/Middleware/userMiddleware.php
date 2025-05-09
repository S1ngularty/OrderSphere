<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            abort(403,'Please Log in first');
        }
        if(Auth::user()->status!=='inactive' && Auth::user()->role!=='user'){
            abort(403,'Unauthenticated User (2)');
        }
        return $next($request);
    }
}
