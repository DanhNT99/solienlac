<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        if(!$request->session()->has('LoginUser') && $request->path() != 'login/index') {
            
            return redirect('login/index');
        }
        if($request->session()->has('LoginUser') && $request->path() == 'login/index') {
            return back();
        }
        
        return $next($request);

    }
}
