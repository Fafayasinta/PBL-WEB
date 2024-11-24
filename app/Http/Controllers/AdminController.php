<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $breadcrumb = (object) [
        'title' => 'Selamat Datang',
        'list'  => ['Home', 'Welcome']
    ];

    $activeMenu = 'dashboard';

    // Menghitung jumlah kegiatan yang selesai
    $totalKegiatanSelesai = 9;  //Kegiatan::where('status', 'selesai')->count(); // Mengambil jumlah kegiatan yang selesai dari database
    
    // Mengirim data ke view
    return view('admin.dashboard', [
        'breadcrumb' => $breadcrumb,
        'activeMenu' => $activeMenu,
        'totalKegiatanSelesai' => $totalKegiatanSelesai
    ]);
}

}
