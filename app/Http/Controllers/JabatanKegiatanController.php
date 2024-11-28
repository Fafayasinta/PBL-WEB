<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KegiatanDosenModel;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JabatanKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'jabatankegiatan';
        $breadcrumb = (object) [
            'title' => 'Data Jabatan Kegiatan',
            'list' => ['Home', 'jabatankegiatan']
        ];

        $jabatankegiatan = KegiatanModel::all();

        return view('admin.jabatankegiatan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'jabatankegiatan' => $jabatankegiatan,
        ]);
    }

    public function list(Request $request)
{
    $jabatankegiatan = KegiatanDosenModel::with('kegiatan') // Eager load relasi kegiatan
        ->select('kegiatan_dosen_id', 'jabatan', 'skor', 'kegiatan_id');

    if ($request->jabatan) {
        $jabatankegiatan->where('jabatan', $request->jabatan);
    }

    return DataTables::of($jabatankegiatan)
        ->addIndexColumn()
        ->addColumn('cakupan_wilayah', function ($jabatankegiatan) {
            // Ambil cakupan_wilayah dari relasi kegiatan
            return $jabatankegiatan->kegiatan->cakupan_wilayah ?? '-';
        })
        ->addColumn('action', function ($jabatankegiatan) {
            $btn  = '<button onclick="modalAction(\'' . url('/jabatankegiatan/' . $jabatankegiatan->kegiatan_dosen_id .
                '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jabatankegiatan/' . $jabatankegiatan->kegiatan_dosen_id .
                '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jabatankegiatan/' . $jabatankegiatan->kegiatan_dosen_id .
                '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}

}
