<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class EmailCheck
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
        Auth::check() ? $userEmail = User::select('email')->where('id', Auth::user()->id)->first() : '';
        if(Auth::check() && $userEmail->email !== null) {
            return $next($request);
        }
        if(Auth::check()) {
            if($userEmail->email !== null) {
                return $next($request);
            }
            return redirect(route('two-step-registration'));
        }


    }
}
