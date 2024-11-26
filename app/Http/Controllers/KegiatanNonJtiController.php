<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanNonJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatannonjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan Non JTI',
            'list' => ['Home', 'kegiatannonjti']
        ];

        return view('admin.kegiatannonjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
