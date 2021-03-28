<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserEmailMustVerify
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
        if (!auth()->user()->email_verified_at) {
            return back()->with('danger', 'verify your email first');
        }
        return $next($request);
    }
}
