<?php

namespace App\Http\Controllers\DosenAnggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanNonJtiDosenController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatannonjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan Non JTI',
            'list' => ['Home', 'kegiatannonjti']
        ];

        return view('dosenanggota.kegiatannonjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
