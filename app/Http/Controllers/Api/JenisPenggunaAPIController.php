<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class JenisPenggunaAPIController extends Controller
{
    public function index()
    {
        $level = LevelModel::all();

        return response()->json([
            'status' => true,
            'message' => 'Data Jenis Pengguna berhasil diambil',
            'data' => $level
        ], 200);
    }

    public function list(Request $request)
    {
        $jenispengguna = LevelModel::select('level_id', 'level_nama')->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar Jenis Pengguna',
            'data' => $jenispengguna
        ], 200);
    }

    public function show_ajax(string $id)
    {
        $jenispengguna = LevelModel::find($id);

        if (!$jenispengguna) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail Jenis Pengguna',
            'data' => $jenispengguna
        ], 200);
    }

    public function update_ajax(Request $request, string $id)
    {
        $rules = [
            'level_nama' => 'required|string|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $jenispengguna = LevelModel::find($id);

        if (!$jenispengguna) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $jenispengguna->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $jenispengguna
        ], 200);
    }

    public function store_ajax(Request $request)
    {
        $rules = [
            'level_nama' => 'required|string|max:100|unique:level_models,level_nama',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $jenispengguna = LevelModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $jenispengguna
        ], 201);
    }

    public function delete_ajax(Request $request, string $id)
    {
        $jenispengguna = LevelModel::find($id);

        if (!$jenispengguna) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $jenispengguna->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
