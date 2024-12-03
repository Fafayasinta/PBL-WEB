<?php

namespace App\Http\Controllers\DosenAnggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DosenAnggotaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        
        return view('dosenAnggota.welcome', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
