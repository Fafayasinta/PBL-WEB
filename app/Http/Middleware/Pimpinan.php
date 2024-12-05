<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class PimpinanMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->level_id == 2) {
            return $next($request);
        }
        return redirect('/login')->with('error', 'Akses ditolak!');
    }
}