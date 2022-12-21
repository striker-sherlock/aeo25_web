<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{

    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::guard('admin')->check());
        if(!Auth::guard('admin')->check()){
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}