<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanNonJtiAPIController extends Controller
{
    /**
     * Menampilkan daftar kegiatan Non JTI
     */
    public function index()
    {
        $kegiatannonjti = KegiatanModel::with(['kategori', 'beban'])
            ->where('kategori_kegiatan_id', 3)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar kegiatan Non JTI',
            'data' => $kegiatannonjti,
        ]);
    }

    /**
     * Menyimpan data kegiatan baru
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_kegiatan' => 'required|string|max:200',
            'pic' => 'required|string|max:100',
            'kategori_kegiatan_id' => 'required|integer|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'cakupan_wilayah' => 'required|string|in:Luar Institusi,Institusi,Jurusan,Program Studi',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'beban_kegiatan_id' => 'required|integer|exists:m_beban_kegiatan,beban_kegiatan_id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ]);
        }

        $kegiatan = KegiatanModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kegiatan berhasil disimpan',
            'data' => $kegiatan,
        ]);
    }

    /**
     * Menampilkan detail kegiatan berdasarkan ID
     */
    public function show($id)
    {
        $kegiatan = KegiatanModel::with(['kategori', 'beban'])->find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail kegiatan',
            'data' => $kegiatan,
        ]);
    }

    /**
     * Memperbarui data kegiatan
     */
    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan',
            ]);
        }

        $rules = [
            'nama_kegiatan' => 'required|string|max:200',
            'pic' => 'required|string|max:100',
            'cakupan_wilayah' => 'required|string|in:Luar Institusi,Institusi,Jurusan,Program Studi',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'beban_kegiatan_id' => 'required|integer|exists:m_beban_kegiatan,beban_kegiatan_id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ]);
        }

        $kegiatan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kegiatan berhasil diperbarui',
            'data' => $kegiatan,
        ]);
    }

    /**
     * Menghapus kegiatan berdasarkan ID
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan',
            ]);
        }

        $kegiatan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kegiatan berhasil dihapus',
        ]);
    }
}
