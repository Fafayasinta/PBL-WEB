<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $jeniskegiatan = KegiatanModel::select('kegiatan_id', 'nama_kegiatan');

        if ($request->nama_kegiatan) {
            $jeniskegiatan->where('nama_kegiatan', $request->nama_kegiatan);
        }

        return DataTables::of($jeniskegiatan)
            ->addIndexColumn()
            ->addColumn('action', function ($jeniskegiatan) {
                $btn  = '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kegiatan_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kegiatan_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kegiatan_id .
                    '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
