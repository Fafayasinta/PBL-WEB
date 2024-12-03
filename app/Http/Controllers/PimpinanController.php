<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KegiatanModel;

class PimpinanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        
        return view('pimpinan.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
    public function kegiatanjti()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        
        return view('pimpinan.kegiatanjti.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
    public function getList(Request $request)
    {
        // // Ambil data dari tabel t_kegiatan
        // $kegiatans = DB::table('t_kegiatan')
        //     ->select('nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'pic', 'progres', 'deskripsi')
        //     ->get();

        // // Kembalikan data dalam format JSON untuk DataTables
        // return response()->json([
        //     'data' => $kegiatans,
        // ]);
    }
}
