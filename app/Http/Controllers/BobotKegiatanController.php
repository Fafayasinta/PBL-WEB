<?php

namespace App\Http\Controllers;

use App\Models\BobotKegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BobotKegiatanController extends Controller
{
    /**
     * Menampilkan daftar bobot kegiatan
     */
    public function index()
    {
        $bobotKegiatan = BobotKegiatanModel::all();
        return response()->json([
            'status' => 'success',
            'data' => $bobotKegiatan
        ]);
    }

    /**
     * Menyimpan bobot kegiatan baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), BobotKegiatanModel::$rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        try {
            $bobotKegiatan = BobotKegiatanModel::create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
                'data' => $bobotKegiatan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    /**
     * Menampilkan detail bobot kegiatan
     */
    public function show($id)
    {
        $bobotKegiatan = BobotKegiatanModel::find($id);
        
        if (!$bobotKegiatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $bobotKegiatan
        ]);
    }

    /**
     * Mengupdate bobot kegiatan
     */
    public function update(Request $request, $id)
    {
        $bobotKegiatan = BobotKegiatanModel::find($id);

        if (!$bobotKegiatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Modifikasi rules untuk update (unique kecuali ID yang sedang diupdate)
        $rules = BobotKegiatanModel::$rules;
        $rules['nama_bobot'] = 'required|string|max:100|unique:m_bobot_kegiatan,nama_bobot,' . $id . ',bobot_kegiatan_id';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        try {
            $bobotKegiatan->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'data' => $bobotKegiatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate data'
            ], 500);
        }
    }

    /**
     * Menghapus bobot kegiatan
     */
    public function destroy($id)
    {
        $bobotKegiatan = BobotKegiatanModel::find($id);

        if (!$bobotKegiatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        try {
            $bobotKegiatan->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500);
        }
    }
}