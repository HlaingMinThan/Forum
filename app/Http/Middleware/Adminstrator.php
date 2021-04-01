<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminstrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isAdmin) {
            return $next($request);
        }
        abort(403, 'u don\'t have permission to do this');
    }
}
