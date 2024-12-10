<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Monolog\Level;
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

        // if ($request->nama_kegiatan) {
        //     $jenispengguna->where('level_nama', $request->level_nama);
        // }

        return DataTables::of($jenispengguna)
            ->addIndexColumn()
            ->addColumn('action', function ($jenispengguna) {
                $btn  = '<button onclick="modalAction(\'' . url('/jenispengguna/' . $jenispengguna->level_id . '/show_ajax') . '\')" 
                            class="btn btn-info btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                            Detail
                         </button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenispengguna/' . $jenispengguna->level_id . '/edit_ajax') . '\')" 
                            class="btn btn-warning btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                            Edit
                        </button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/jenispengguna/' . $jenispengguna->level_id . '/delete_ajax') . '\')"  
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
        $jenispengguna = LevelModel::find($id);
        return view('admin.jenispengguna.show_ajax', ['jenispengguna' => $jenispengguna]);
    }

    public function edit_ajax(string $id)
    {
        $jenispengguna = LevelModel::find($id);

        return view('admin.jenispengguna.edit_ajax', ['jenispengguna' => $jenispengguna]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_nama' => 'required|string|max:100',
                'level_deskripsi' => 'required|string|max:255',
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

            $check = LevelModel::find($id);
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
        return redirect('/jenispengguna');
    }

    public function confirm_ajax(string $id)
    {
        $jenispengguna = LevelModel::find($id);

        return view('admin.jenispengguna.confirm_ajax', ['jenispengguna' => $jenispengguna]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jenispengguna = LevelModel::find($id);

            if ($jenispengguna) {
                $jenispengguna->delete();
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
            return redirect('/jenispengguna');
        }
    }
}
