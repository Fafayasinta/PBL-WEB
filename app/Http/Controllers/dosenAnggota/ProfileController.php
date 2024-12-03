<?php

namespace App\Http\Controllers\DosenAnggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $activeMenu = 'profile';
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['Home', 'profile']
        ];

        return view('dosenAnggota.profile.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
