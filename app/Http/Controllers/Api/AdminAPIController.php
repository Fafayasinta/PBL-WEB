<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use Yajra\DataTables\DataTables;

class AdminAPIController extends Controller
{
    public function index()
    {
        // Contoh data yang sebelumnya ditampilkan di view
        $breadcrumb = [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome'],
        ];

        $activeMenu = 'dashboard';

        // Menghitung jumlah kegiatan yang selesai
        $totalKegiatanSelesai = 9; // Contoh data dummy, gunakan query sebenarnya jika tersedia.

        // Mengirim respons JSON
        return response()->json([
            'status' => 'success',
            'data' => [
                'breadcrumb' => $breadcrumb,
                'activeMenu' => $activeMenu,
                'totalKegiatanSelesai' => $totalKegiatanSelesai,
            ],
        ], 200);
    }

    public function list(Request $request)
    {
        // Query data kegiatan
        $admin = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'pic', 'progres', 'keterangan');

        // Filter berdasarkan nama kegiatan jika ada parameter
        if ($request->nama_kegiatan) {
            $admin->where('nama_kegiatan', $request->nama_kegiatan);
        }

        // Menggunakan DataTables jika perlu
        $data = DataTables::of($admin)
            ->addIndexColumn()
            ->make(true);

        // Konversi ke array untuk keperluan JSON
        $response = $data->getData(true);

        return response()->json([
            'status' => 'success',
            'data' => $response['data'],
        ], 200);
    }
}
