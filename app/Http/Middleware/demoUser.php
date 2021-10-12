<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class demoUser
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
		if(auth()->user()->name == 'Demo'){
			return redirect('/')->withErrors(['demo'=>'Demo user can not do that!'. PHP_EOL. 'Sign up to use all the functions.' ]);
		}
        return $next($request);
    }
}
