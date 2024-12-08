<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\KategoriKegiatanModel;
use App\Models\BebanKegiatanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanJtiAPIController extends Controller
{
    /**
     * Menampilkan daftar kegiatan JTI
     */
    public function index()
    {
        $kegiatanjti = KegiatanModel::with(['kategori', 'beban', 'user'])
            ->whereIn('kategori_kegiatan_id', [1, 2])
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data kegiatan JTI berhasil diambil',
            'data' => $kegiatanjti
        ], 200);
    }

    /**
     * Menyimpan data kegiatan JTI baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:m_user,user_id',
            'kategori_kegiatan_id' => 'required|integer|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'beban_kegiatan_id' => 'required|integer|exists:m_beban_kegiatan,beban_kegiatan_id',
            'nama_kegiatan' => 'required|string|max:200',
            'pic' => 'required|string|max:100',
            'cakupan_wilayah' => 'required|in:Luar Institusi,Institusi,Jurusan,Program Studi',
            'deskripsi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date',
            'deadline' => 'required|date',
            'status' => 'required|in:Belum Proses,Proses,Selesai',
            'progres' => 'required|numeric|between:0,100',
            'keterangan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kegiatan = KegiatanModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data kegiatan JTI berhasil disimpan',
            'data' => $kegiatan
        ], 201);
    }

    /**
     * Menampilkan detail kegiatan JTI
     */
    public function show($id)
    {
        $kegiatan = KegiatanModel::with(['kategori', 'beban', 'user'])->find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Data kegiatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail data kegiatan berhasil diambil',
            'data' => $kegiatan
        ], 200);
    }

    /**
     * Mengupdate data kegiatan JTI
     */
    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Data kegiatan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'integer|exists:m_user,user_id',
            'kategori_kegiatan_id' => 'integer|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'beban_kegiatan_id' => 'integer|exists:m_beban_kegiatan,beban_kegiatan_id',
            'nama_kegiatan' => 'string|max:200',
            'pic' => 'string|max:100',
            'cakupan_wilayah' => 'in:Luar Institusi,Institusi,Jurusan,Program Studi',
            'deskripsi' => 'string|max:255',
            'waktu_mulai' => 'date',
            'waktu_selesai' => 'date',
            'deadline' => 'date',
            'status' => 'in:Belum Proses,Proses,Selesai',
            'progres' => 'numeric|between:0,100',
            'keterangan' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kegiatan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data kegiatan JTI berhasil diperbarui',
            'data' => $kegiatan
        ], 200);
    }

    /**
     * Menghapus data kegiatan JTI
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Data kegiatan tidak ditemukan'
            ], 404);
        }

        $kegiatan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data kegiatan JTI berhasil dihapus'
        ], 200);
    }
}
