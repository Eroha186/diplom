<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;


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
        if(!(Auth::check() && Auth::user()->admin == 1)) {
            return redirect('/account/personal-data')->with('error', 'Недостаточно прав для доступа');
        }
        response(Cookie::queue(Cookie::make('admin', 1)));
        return $next($request);
    }
}
