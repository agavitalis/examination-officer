<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class studentMiddleware
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
        $typeOfUser=Auth::user()->user;

            if ( $typeOfUser !='student')
            {
                return back()->with('error','You have no permissions to access beyond this point');        
            }
            else
            {
                 return $next($request);
            }
    }
}
