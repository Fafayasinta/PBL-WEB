<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatanjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan JTI',
            'list' => ['Home', 'kegiatanjti']
        ];

        return view('admin.kegiatanjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
