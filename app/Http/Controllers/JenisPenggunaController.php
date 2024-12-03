<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisPenggunaController extends Controller
{
    public function index()
    {
        $activeMenu = 'jenispengguna';
        $breadcrumb = (object) [
            'title' => 'Data Jenis Pengguna',
            'list' => ['Home', 'jenispengguna']
        ];

        $level = LevelModel::all();

        return view('admin.jenispengguna.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'level' => $level
        ]);
    }

    public function list(Request $request)
    {
        $jenispengguna = LevelModel::select('level_id', 'level_nama');

        if ($request->nama_kegiatan) {
            $jenispengguna->where('level_nama', $request->level_nama);
        }

        return DataTables::of($jenispengguna)
            ->addIndexColumn()
            ->addColumn('action', function ($jenispengguna) {
                $btn  = '<button onclick="modalAction(\'' . url('/jenispengguna/' . $jenispengguna->level_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenispengguna/' . $jenispengguna->level_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenispengguna/' . $jenispengguna->level_id .
                    '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
