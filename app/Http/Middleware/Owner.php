<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Owner
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
        if (Auth::check()) {
            // The user is logged in...
                if (auth()->user()->level == 1) {
                    return $next($request);
                }else{
                    return redirect('login');
                }
        }else{
            return redirect('login');
        }
    }
}
