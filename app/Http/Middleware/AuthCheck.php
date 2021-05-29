<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

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
        // if(!$request->session()->has('nameUser') && $request->path() != 'login/index') {
            
        //     return redirect('login/index');
        // }
        // if($request->session()->has('nameUser') && $request->path() == 'login/index') {
        //     return back();
        // }
        
        // return $next($request);

        if(Auth::guard('giao_vien')->check() ||Auth::guard('phu_huynh')->check()){
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
