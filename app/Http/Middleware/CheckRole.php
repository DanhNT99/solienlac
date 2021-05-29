<?php

namespace App\Http\Middleware;

use Closure, Auth;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $nameRole)
    {

        if(Auth::guard('giao_vien')->user()->hasRole($nameRole)) {
            return $next($request);
        }
        else {
            return abort(403, 'This action is unauthorized.');
        }

    }
}
