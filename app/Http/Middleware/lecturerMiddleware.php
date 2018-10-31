<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class lecturerMiddleware
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

       if ( Auth::user()->user !='lecturer')
            {
                return back()->with('error','You have no permissions to access beyond this point');        
            }
            else
            {
                return $next($request);
            }
    }
}
