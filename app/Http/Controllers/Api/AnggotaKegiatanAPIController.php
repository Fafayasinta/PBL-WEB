<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKegiatanModel;
use Illuminate\Http\Request;

class AnggotaKegiatanAPIController extends Controller
{
    public function index()
    {
        $anggota = AnggotaKegiatanModel::with(['user', 'kegiatan'])->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data anggota berhasil diambil',
            'data' => $anggota,
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'kegiatan_id' => 'required|exists:t_kegiatan,kegiatan_id',
            'jabatan' => 'required|in:PIC,ANGGOTA',
            'beban_kerja' => 'required|numeric',
        ]);

        $anggota = AnggotaKegiatanModel::create($validatedData);
        return response()->json([
            'status' => 'success',
            'message' => 'Anggota kegiatan berhasil ditambahkan',
            'data' => $anggota,
        ], 201);
    }

    public function show($id)
    {
        $anggota = AnggotaKegiatanModel::with(['user', 'kegiatan'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Data anggota berhasil ditemukan',
            'data' => $anggota,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'exists:m_user,user_id',
            'kegiatan_id' => 'exists:t_kegiatan,kegiatan_id',
            'jabatan' => 'in:PIC,ANGGOTA',
            'beban_kerja' => 'numeric',
        ]);

        $anggota = AnggotaKegiatanModel::findOrFail($id);
        $anggota->update($validatedData);
        return response()->json([
            'status' => 'success',
            'message' => 'Anggota kegiatan berhasil diperbarui',
            'data' => $anggota,
        ], 200);
    }

    public function destroy($id)
    {
        $anggota = AnggotaKegiatanModel::findOrFail($id);
        $anggota->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Anggota kegiatan berhasil dihapus',
        ], 204);
    }
}
