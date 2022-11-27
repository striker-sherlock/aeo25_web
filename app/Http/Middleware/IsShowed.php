<?php

namespace App\Http\Middleware;
use App\Models\Environment;

use Closure;
use Illuminate\Http\Request;

class isShowed
{
 
    public function handle(Request $request, Closure $next, string $code)
    {
        $page = Environment::where('env_code', $code)->first();

        if(!$page->is_showed){
            return abort(404);
        }
        return $next($request);
    }
}
