<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;

class JenisPenggunaController extends Controller
{
    public function index()
    {
        $activeMenu = 'jenispengguna';
        $breadcrumb = (object) [
            'title' => 'Data Jenis Pengguna',
            'list' => ['Home', 'jenispengguna']
        ];

        return view('admin.jenispengguna.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
