<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    public function handle(Request $request, Closure $next, $level)
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Cek level dan redirect sesuai kebutuhan
            if ($level == 'admin' && $user->level_id == 1) {
                return $next($request); // Arahkan ke dashboard admin
            }

            if ($level == 'dosen' && $user->level_id == 2) {
                return $next($request); // Arahkan ke dashboard dosen
            }
        }

        // Jika tidak sesuai dengan level, redirect ke halaman home atau login
        return redirect('/')->with('error', 'You do not have access to this page');
    }
}