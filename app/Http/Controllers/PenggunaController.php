<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller
{
    public function index()
    {
        $activeMenu = 'pengguna';
        $breadcrumb = (object) [
            'title' => 'Data Pengguna',
            'list' => ['Home', 'Pengguna']
        ];

        $level = LevelModel::all();

        return view('admin.pengguna.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'level' => $level
        ]);
    }

    public function list(Request $request)
    {
        $pengguna = UserModel::with('level') // Eager load relasi kegiatan
        ->select('user_id', 'nama', 'username', 'password');

        if ($request->level_nama) {
            $pengguna->where('level_nama', $request->level_nama);
        }

        return DataTables::of($pengguna)
            ->addIndexColumn()
            ->addColumn('level_nama', function ($pengguna) {
                return $pengguna->level->level_nama ?? '-';
            })
            ->addColumn('action', function ($pengguna) {
                $btn  = '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id .
                    '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
