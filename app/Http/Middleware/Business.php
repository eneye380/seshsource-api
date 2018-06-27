<?php

namespace SeshSource\Http\Middleware;

use Closure;

class Business
{

    /**
     * A list of user types allowed to access business sections
     *
     * @var array
     */
    private $businessTypes = [
        'admin',
        'organizer'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $request->user() && in_array($request->user(), $this->businessTypes) )
        {
            return redirect('/');
        }
        return $next($request);
    }
}
