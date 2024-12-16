<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use App\Models\AnggotaKegiatanModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class StatistikController extends Controller
{
    public function index()
    {
        $activeMenu = 'statistik';
        $breadcrumb = (object) [
            'title' => 'Statistik Beban Kerja Dosen',
            'list' => ['Home', 'Statistik']
        ];
    
        // Role redirect
        switch (auth()->user()->level->level_kode) {
            case ('ADMIN'):
                $redirect = 'admin';
                break;
            case ('PIMPINAN'):
                $redirect = 'pimpinan';
                break;
            default:
                abort(403, 'Unauthorized action.');
        }
    
        // Data untuk statistik
        $totalKegiatan = KegiatanModel::count();
        $totalKegiatanSelesai = KegiatanModel::where('status', 'selesai')->count();
        $totalKegiatanProses = KegiatanModel::where('status', 'proses')->count();
        $totalKegiatanBelum = KegiatanModel::where('status', 'belum proses')->count();

        $jtiTerpogram = KegiatanModel::where('kategori_kegiatan_id', 1)->count();
        $jtiNonProgram = KegiatanModel::where('kategori_kegiatan_id', 2)->count();
        $nonJti = KegiatanModel::where('kategori_kegiatan_id', 3)->count();

        $statistik = KegiatanModel::select([
            'user_id',
            DB::raw('COUNT(CASE WHEN kategori_kegiatan_id = 1 THEN 1 END) as total_kategori_1'),
            DB::raw('COUNT(CASE WHEN kategori_kegiatan_id = 2 THEN 1 END) as total_kategori_2'),
            DB::raw('COUNT(CASE WHEN kategori_kegiatan_id = 3 THEN 1 END) as total_kategori_3'),
            DB::raw('COUNT(kegiatan_id) as total_kegiatan') // Menghitung jumlah total kegiatan berdasarkan kegiatan_id
        ])
        ->groupBy('user_id')  // Mengelompokkan berdasarkan user_id
        ->get();

    
        // Data untuk chart
        $chartData = [
            'labels' => ['Kegiatan JTI Terpogram', 'Kegiatan JTI Non Program', 'Kegiatan Non JTI'],
            'datasets' => [
                [
                    'data' => [$jtiTerpogram, $jtiNonProgram, $nonJti],
                    'backgroundColor' => ['#4CAF50', '#FFC107', '#F44336'],
                ],
            ],
        ];
    
        // Mengirim data ke view
        return view($redirect . '.statistik.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'totalKegiatan' => $totalKegiatan,
            'totalKegiatanSelesai' => $totalKegiatanSelesai,
            'totalKegiatanProses' => $totalKegiatanProses,
            'totalKegiatanBelum' => $totalKegiatanBelum,
            'chartData' => $chartData, // Kirim sebagai array, bukan JSON string
            'statistik' => $statistik
        ]);
    }

    public function listDosenKegiatan(Request $request)
    {
        // Menghitung jumlah kegiatan per dosen
        $data = AnggotaKegiatanModel::with('user')
            ->selectRaw('user_id, COUNT(kegiatan_id) as total_kegiatan')
            ->groupBy('user_id')
            ->get();
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_dosen', function ($row) {
                return $row->user->nama ?? '-';
            })
            ->addColumn('total_kegiatan', function ($row) {
                return $row->total_kegiatan;
            })
            ->make(true);
    }

    public function list(Request $request)
{
    $data = KegiatanModel::select([
        'user_id',
        DB::raw('SUM(CASE WHEN kategori_kegiatan_id = 1 THEN 1 ELSE 0 END) as total_kategori_1'),
        DB::raw('SUM(CASE WHEN kategori_kegiatan_id = 2 THEN 1 ELSE 0 END) as total_kategori_2'),
        DB::raw('SUM(CASE WHEN kategori_kegiatan_id = 3 THEN 1 ELSE 0 END) as total_kategori_3')
    ])
    ->groupBy('user_id');

    return DataTables::of($data)
        ->addIndexColumn() // Menambahkan nomor indeks otomatis
        ->make(true); // Mengembalikan JSON untuk DataTables
}


}
