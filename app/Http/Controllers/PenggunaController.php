<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Monolog\Level;
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
            $btn  = '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/pengguna/' . $pengguna->user_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function show_ajax(string $id){
        
        $pengguna = UserModel::find($id);

        return view('admin.pengguna.show_ajax', ['pengguna' => $pengguna]);
    }

    public function create_ajax()
    {
        $pengguna = UserModel::select('user_id', 'level_id', 'username', 'password', 'nama', 'nip', 'email')->get();

        return view('admin.pengguna.create_ajax')->with('pengguna', $pengguna);
    }

    public function store_ajax(Request $request)
{
    // Mengecek apakah request AJAX atau JSON
    if ($request->ajax() || $request->wantsJson()) {
        // Validasi input
        $rules = [
            'level_id'  => 'required|integer',
            'username'  => 'required|string|min:3|unique:m_user,username',
            'nama'      => 'required|string|max:100',
            'password'  => 'required|min:5',
            'nip'       => 'required|string|max:50|unique:m_user,nip',
            'email'     => 'required|string|unique:m_user,email',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi foto_profil
            'email_verified_at' => 'nullable|date',
            'remember_token'    => 'nullable|string|max:100',
            'deleted_at'        => 'nullable|date'
        ];

        // Melakukan validasi
        $validator = Validator::make($request->all(), $rules);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        // Menyimpan foto profil jika ada file yang diupload
        $fotoProfilPath = null;
        if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()) {
            $fotoProfil = $request->file('foto_profil');
            // Menyimpan file ke storage/public/foto_profil dan mendapatkan pathnya
            $fotoProfilPath = $fotoProfil->store('public/foto_profil');
        }

        // Menyimpan data pengguna ke dalam database
        UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'password' => bcrypt($request->password),  // Enkripsi password
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'foto_profil' => $fotoProfilPath, // Menyimpan path foto profil
            'email_verified_at' => $request->email_verified_at,
            'remember_token' => $request->remember_token,
            'deleted_at' => $request->deleted_at
        ]);

        // Mengembalikan response sukses
        return response()->json([
            'status' => true,
            'message' => 'Data Pengguna berhasil disimpan'
        ]);
    }

    // Jika bukan request AJAX, redirect ke halaman pengguna
    return redirect('/pengguna');
}


    public function edit_ajax(string $id)
    {
        $pengguna = UserModel::find($id);

        return view('admin.pengguna.edit_ajax', ['pengguna' => $pengguna]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|max:100',
                'username' => 'required|string|max:50|unique:m_user,user_id,' . $id . ',user_id',
                'level_id' => 'required|integer',
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error
                ]);
            }

            $check = UserModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/pengguna');
    }

    public function confirm_ajax(string $id)
    {
        $pengguna = UserModel::find($id);

        return view('admin.pengguna.confirm_ajax', ['pengguna' => $pengguna]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $pengguna = UserModel::find($id);

            if ($pengguna) {
                $pengguna->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
            return redirect('/pengguna');
        }
    }
}   
