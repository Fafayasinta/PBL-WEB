<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'jeniskegiatan';
        $breadcrumb = (object) [
            'title' => 'Kelola Jenis Kegiatan',
            'list' => ['Home', 'Jenis Kegiatan']
        ];
        
        $jeniskegiatan = KegiatanModel::all();

        return view('admin.jeniskegiatan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'jeniskegiatan' => $jeniskegiatan
        ]);
    }

    public function list(Request $request)
    {
        $jeniskegiatan = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori');

        if ($request->nama_kategori) {
            $jeniskegiatan->where('nama_kategori', $request->nama_kategori);
        }

        return DataTables::of($jeniskegiatan)
        ->addIndexColumn()
        ->addColumn('action', function ($jeniskegiatan) {
            $btn  = '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kategori_kegiatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kategori_kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kategori_kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })             
        ->rawColumns(['action'])
        ->make(true);
    }
}
