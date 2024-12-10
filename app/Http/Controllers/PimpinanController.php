<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PimpinanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        // Menghitung jumlah kegiatan yang selesai
        $totalKegiatan = KegiatanModel::count();  
        $totalKegiatanSelesai = KegiatanModel::where('status', 'selesai')->count();  
        $totalKegiatanProses = KegiatanModel::where('status', 'proses')->count();  
        $totalKegiatanBelum = KegiatanModel::where('status', 'belum proses')->count();   
    
        // Mengirim data ke view
        return view('pimpinan.dashboard', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'totalKegiatan' => $totalKegiatan,
            'totalKegiatanSelesai' => $totalKegiatanSelesai,
            'totalKegiatanProses' => $totalKegiatanProses,
            'totalKegiatanBelum' => $totalKegiatanBelum
        ]);
    }

    public function list(Request $request)
    {
        // Query awal untuk mengambil data kegiatan
        $admin = KegiatanModel::select(
            'kegiatan_id',
            'nama_kegiatan',
            'waktu_mulai',
            'waktu_selesai',
            'user_id',
            'keterangan'
        )->with('user');

        // Filter berdasarkan nama kegiatan jika ada
        if ($request->nama_kegiatan) {
            $admin->where('nama_kegiatan', 'like', '%' . $request->nama_kegiatan . '%');
        }

        // Perhitungan progres berdasarkan agenda
        $data = $admin->get()->map(function ($item) {
            $totalAgenda = $item->agenda()->count(); // Total agenda terkait kegiatan
            $completedAgenda = $item->agenda()->where('progres', 1)->count(); // Agenda yang selesai

            // Hitung progres sebagai persentase
            $item->progres = $totalAgenda > 0 ? round(($completedAgenda / $totalAgenda) * 100, 2) : 0;

            return $item;
        });

        // Return data ke DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}