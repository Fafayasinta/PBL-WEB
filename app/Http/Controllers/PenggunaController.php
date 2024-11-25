<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $activeMenu = 'pengguna';
        $breadcrumb = (object) [
            'title' => 'Data Pengguna',
            'list' => ['Home', 'Pengguna']
        ];

        return view('admin.pengguna.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
