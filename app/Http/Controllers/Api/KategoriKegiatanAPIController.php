<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanModel;
use Illuminate\Http\Request;

class KategoriKegiatanAPIController extends Controller
{
    public function index()
    {
        $kategori = KategoriKegiatanModel::all();

        return response()->json([
            'status' => true,
            'message' => 'Daftar kategori kegiatan berhasil diambil',
            'data' => $kategori
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,nama_kategori',
            'deskripsi' => 'required|string',
        ]);

        $kategori = KategoriKegiatanModel::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Kategori kegiatan berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    public function show(KategoriKegiatanModel $kategoriKegiatan)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail kategori kegiatan',
            'data' => $kategoriKegiatan
        ], 200);
    }

    public function update(Request $request, KategoriKegiatanModel $kategoriKegiatan)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,nama_kategori,' . $kategoriKegiatan->kategori_kegiatan_id . ',kategori_kegiatan_id',
            'deskripsi' => 'required|string',
        ]);

        $kategoriKegiatan->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Kategori kegiatan berhasil diperbarui',
            'data' => $kategoriKegiatan
        ], 200);
    }

    public function destroy(KategoriKegiatanModel $kategoriKegiatan)
    {
        if ($kategoriKegiatan->kegiatan()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori tidak dapat dihapus karena masih digunakan dalam kegiatan'
            ], 400);
        }

        $kategoriKegiatan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kategori kegiatan berhasil dihapus'
        ], 200);
    }
}
