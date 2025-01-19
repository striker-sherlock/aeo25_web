<?php

namespace App\Http\Middleware;

use App\Models\Environment;
use Closure;
use Illuminate\Http\Request;

class isShowed
{
    public function handle(Request $request, Closure $next, string $code)
    {
        // Query untuk mencari data berdasarkan env_code
        $page = Environment::where('env_code', $code)->first();

        // Jika data tidak ditemukan atau is_showed bernilai false
        if (!$page || !$page->is_showed) {
            return abort(404);
        }

        // Lanjutkan permintaan jika valid
        return $next($request);
    }
}
