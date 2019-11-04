<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class dontSelf
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
        if(auth()->user() == $request->user) {
            return redirect(route('profile.index', ['user' => auth()->user()]));
        }

        return $next($request);
    }
}
