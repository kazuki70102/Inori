<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Driver
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
        if (auth()->user()->role != 'driver') {
            return redirect(route('profile.index'));
        }
        
        return $next($request);
    }
}
