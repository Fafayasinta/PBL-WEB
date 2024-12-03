<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        
        return view('pimpinan.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
