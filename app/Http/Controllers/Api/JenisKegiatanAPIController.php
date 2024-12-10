<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class JenisKegiatanAPIController extends Controller
{
    public function index()
    {
        $jeniskegiatan = KegiatanModel::all();

        return response()->json([
            'status' => true,
            'message' => 'Data Jenis Kegiatan berhasil diambil',
            'data' => $jeniskegiatan
        ], 200);
    }

    public function list(Request $request)
    {
        $jeniskegiatan = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori')->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar Jenis Kegiatan',
            'data' => $jeniskegiatan
        ], 200);
    }

    public function show_ajax(string $id)
    {
        $jeniskegiatan = KategoriKegiatanModel::find($id);

        if (!$jeniskegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail Jenis Kegiatan',
            'data' => $jeniskegiatan
        ], 200);
    }

    public function update_ajax(Request $request, string $id)
    {
        $rules = [
            'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,nama_kategori,' . $id . ',kategori_kegiatan_id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $jeniskegiatan = KategoriKegiatanModel::find($id);

        if (!$jeniskegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $jeniskegiatan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $jeniskegiatan
        ], 200);
    }

    public function store_ajax(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,nama_kategori',
            'deskripsi' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $jeniskegiatan = KategoriKegiatanModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $jeniskegiatan
        ], 201);
    }

    public function delete_ajax(Request $request, string $id)
    {
        $jeniskegiatan = KategoriKegiatanModel::find($id);

        if (!$jeniskegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $jeniskegiatan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
