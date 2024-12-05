<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class DosenMiddleware 
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->level_id == 3) {
            return $next($request);
        }
        return redirect('/login')->with('error', 'Akses ditolak!');
    }
}