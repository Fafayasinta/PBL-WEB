<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KegiatanNonJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatannonjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan Non JTI',
            'list' => ['Home', 'kegiatannonjti']
        ];

        return view('admin.kegiatannonjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
    public function indexP()
    {
        $activeMenu = 'kegiatannonjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan Non JTI',
            'list' => ['Home', 'kegiatannonjti']
        ];

        return view('pimpinan.kegiatannonjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }
    public function list(Request $request)
    {
        $kegiatannonjti = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'pic', 'kategori_kegiatan_id', 'cakupan_wilayah', 'waktu_mulai', 'beban_kegiatan_id')
            ->with('kategori')
            ->with('beban')
            ->whereIn('kategori_kegiatan_id', [3]);

    //  if ($request->nama_kategori) {
    //         $kegiatannonjti->whereHas('kategori_kegiatan', function ($query) use ($request) {
    //             $query->where('nama_kategori', $request->nama_kategori);
    //      });
    //  }

    //  if ($request->status) {
    //      $kegiatannonjti->where('status', $request->status);
    //  }

        return DataTables::of($kegiatannonjti)
        ->addIndexColumn()
        ->addColumn('action', function ($kegiatannonjti) {
            $btn  = '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }
}
