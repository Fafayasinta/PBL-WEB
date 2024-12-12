<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Arahkan ke dashboard admin jika level_id = 1
            if ($user->level_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            // Arahkan ke dashboard dosen jika level_id = 2
            if ($user->level_id == 2) {
                return redirect()->route('dosen.dashboard');
            }
        }

        return redirect()->route('login');
    }
}
