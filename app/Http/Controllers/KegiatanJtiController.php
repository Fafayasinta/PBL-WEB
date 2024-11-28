<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KegiatanJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatanjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan JTI',
            'list' => ['Home', 'kegiatanjti']
        ];

        $status = KegiatanModel::all();

        return view('admin.kegiatanjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'status' => $status
        ]);
    }

    public function list(Request $request)
{
    $kegiatanjti = KegiatanModel::with(['kategori_kegiatan', 'beban_kegiatan']) // Eager load relasi
        ->select('kegiatan_id', 'nama_kegiatan', 'status');

    if ($request->nama_kategori) {
        $kegiatanjti->whereHas('kategori_kegiatan', function ($query) use ($request) {
            $query->where('nama_kategori', $request->nama_kategori);
        });
    }

    if ($request->status) {
        $kegiatanjti->where('status', $request->status);
    }

    return DataTables::of($kegiatanjti)
        ->addIndexColumn()
        ->addColumn('deskripsi', function ($kegiatanjti) {
            return $kegiatanjti->kategori_kegiatan->deskripsi ?? '-';
        })
        ->addColumn('nama_kategori', function ($kegiatanjti) {
            return $kegiatanjti->kategori_kegiatan->nama_kategori ?? '-';
        })
        ->addColumn('nama_beban', function ($kegiatanjti) {
            return $kegiatanjti->beban_kegiatan->nama_beban ?? '-';
        })
        ->addColumn('action', function ($kegiatanjti) {
            $btn  = '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id .
                '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id .
                '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id .
                '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }
}
