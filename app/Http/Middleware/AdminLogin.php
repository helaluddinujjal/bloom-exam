<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class AdminLogin
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
        if (empty(Session::has('adminSession'))) {
            return redirect('/admin')->with('error_msg',"Login Please");
        }
        return $next($request);
    }
}