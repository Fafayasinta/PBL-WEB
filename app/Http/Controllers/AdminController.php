<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

    public function list(Request $request)
    {
        $admin = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'pic', 'progres', 'deskripsi');

        if ($request->nama_kegiatan) {
            $admin->where('nama_kegiatan', $request->nama_kegiatan);
        }

        return DataTables::of($admin)
            ->addIndexColumn()
            ->make(true);
    }
}
