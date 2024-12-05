<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            switch($user->level_id) {
                case 1:
                    return redirect('/admin/dashboard');
                case 2:
                    return redirect('/pimpinan/dashboard');
                case 3:
                    return redirect('/dosen/dashboard');
                default:
                    return redirect('/home');
            }
        }
    }

    return $next($request);
}
    
}
