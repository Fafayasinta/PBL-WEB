<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->level_id != $role) {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}