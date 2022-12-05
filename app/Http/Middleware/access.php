<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccessControl;
use Illuminate\Support\Facades\Auth;

class access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $control_id)
    {
        $get_access= AccessControl::where("admin_id",Auth::guard('admin')->user()->id)
                                    ->where("access_id",$control_id)->get();
        
        if(count($get_access) == 0){
            return redirect()->back()->with("error","You are not authorized");
        }
        return $next($request);
    }
}
