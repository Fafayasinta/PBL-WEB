<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JabatanKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'jabatankegiatan';
        $breadcrumb = (object) [
            'title' => 'Data Jabatan Kegiatan',
            'list' => ['Home', 'jabatankegiatan']
        ];

        return view('admin.jabatankegiatan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
