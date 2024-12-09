<?php
namespace App\Http\Controllers;

use App\Models\AnggotaKegiatanModel;
use Illuminate\Http\Request;

class AnggotaKegiatanController extends Controller
{
    public function index()
    {
        $anggota = AnggotaKegiatanModel::with(['user', 'kegiatan'])->get();
        return response()->json($anggota);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'kegiatan_id' => 'required|exists:t_kegiatan,kegiatan_id',
            'jabatan' => 'required|in:PIC,ANGGOTA',
            'beban_kerja' => 'required|numeric'
        ]);

        $anggota = AnggotaKegiatanModel::create($request->all());
        return response()->json($anggota, 201);
    }

    public function show($id)
    {
        $anggota = AnggotaKegiatanModel::with(['user', 'kegiatan'])->findOrFail($id);
        return response()->json($anggota);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'exists:m_user,user_id',
            'kegiatan_id' => 'exists:t_kegiatan,kegiatan_id',
            'jabatan' => 'in:PIC,ANGGOTA',
            'beban_kerja' => 'numeric'
        ]);

        $anggota = AnggotaKegiatanModel::findOrFail($id);
        $anggota->update($request->all());
        return response()->json($anggota);
    }

    public function destroy($id)
    {
        $anggota = AnggotaKegiatanModel::findOrFail($id);
        $anggota->delete();
        return response()->json(null, 204);
    }
}