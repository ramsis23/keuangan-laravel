<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Penerimaan
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
		if(Auth::user()->role != 3){
			return redirect()->guest('/')->with('error',"You are not allowed to access this");
		}
		
        return $next($request);
    }
}
