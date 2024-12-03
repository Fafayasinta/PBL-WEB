<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Foundation\Auth\User;
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

        $level = UserModel::all();

        return view('admin.pengguna.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'level' => $level
        ]);
    }

    public function list(Request $request)
    {
    $pengguna = UserModel::select('user_id','level_id', 'nama', 'username')
        ->with('level');

    return DataTables::of($pengguna)
        ->addIndexColumn()
        ->addColumn('action', function ($pengguna) {
            $btn  = '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id . '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['action', 'password']) // Pastikan kolom 'password' mendukung HTML
        ->make(true);
    }
}   
