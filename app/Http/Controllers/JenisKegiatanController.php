<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'jeniskegiatan';
        $breadcrumb = (object) [
            'title' => 'Kelola Jenis Kegiatan',
            'list' => ['Home', 'Jenis Kegiatan']
        ];

        return view('admin.jeniskegiatan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
