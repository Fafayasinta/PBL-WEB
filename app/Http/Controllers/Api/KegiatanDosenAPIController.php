<?php
namespace App\Http\Controllers;

use App\Models\KegiatanDosenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanDosenAPIController extends Controller
{
    /**
     * Menampilkan daftar kegiatan dosen
     */
    public function index()
    {
        $kegiatanDosen = KegiatanDosenModel::with(['user', 'kegiatan'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $kegiatanDosen
        ]);
    }

    /**
     * Menyimpan kegiatan dosen baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:m_user,user_id',
            'kegiatan_id' => 'required|exists:t_kegiatan,kegiatan_id',
            'deadline' => 'required|date',
            'jabatan' => 'required|string',
            'beban_kerja' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $kegiatanDosen = KegiatanDosenModel::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Kegiatan dosen berhasil ditambahkan',
            'data' => $kegiatanDosen
        ], 201);
    }

    /**
     * Menampilkan detail kegiatan dosen
     */
    public function show($id)
    {
        $kegiatanDosen = KegiatanDosenModel::with(['user', 'kegiatan'])->find($id);
        
        if (!$kegiatanDosen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan dosen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $kegiatanDosen
        ]);
    }

    /**
     * Memperbarui kegiatan dosen
     */
    public function update(Request $request, $id)
    {
        $kegiatanDosen = KegiatanDosenModel::find($id);

        if (!$kegiatanDosen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan dosen tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:m_user,user_id',
            'kegiatan_id' => 'exists:t_kegiatan,kegiatan_id',
            'deadline' => 'date',
            'jabatan' => 'string',
            'beban_kerja' => 'numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $kegiatanDosen->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Kegiatan dosen berhasil diperbarui',
            'data' => $kegiatanDosen
        ]);
    }

    /**
     * Menghapus kegiatan dosen
     */
    public function destroy($id)
    {
        $kegiatanDosen = KegiatanDosenModel::find($id);

        if (!$kegiatanDosen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan dosen tidak ditemukan'
            ], 404);
        }

        $kegiatanDosen->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kegiatan dosen berhasil dihapus'
        ]);
    }
}