<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class UserLogin
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
        if (empty(Session::has('userSession'))) {
            return redirect('/')->with('error_msg',"Login Please");
        }
        return $next($request);
    }
}