<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;

class AuthTeacher
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
        if(Auth::guard('admin')->check()==false)
        {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
