<?php

namespace SeshSource\Http\Middleware;

use Closure;

class Admin
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
        if (! $request->user() || $request->user()->isAdmin()) {
            return redirect('/login');
        }
            
        return $next($request);
    }
}
