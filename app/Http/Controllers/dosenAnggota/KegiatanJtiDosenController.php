<?php

namespace App\Http\Controllers\DosenAnggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanJtiDosenController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatanjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan JTI',
            'list' => ['Home', 'kegiatanjti']
        ];

        return view('dosenAnggota.kegiatanjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
