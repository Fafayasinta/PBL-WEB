<?php
namespace App\Http\Controllers;

use App\Models\BobotDosenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BobotDosenController extends Controller
{
    /**
     * Menampilkan semua data bobot dosen
     */
    public function index()
    {
        $bobotDosen = BobotDosenModel::with(['user', 'bobotKegiatan'])->get();
        return response()->json([
            'success' => true,
            'data' => $bobotDosen
        ]);
    }

    /**
     * Menyimpan data bobot dosen baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:m_user,user_id',
            'bobot_kegiatan_id' => 'required|exists:m_bobot_kegiatan,bobot_kegiatan_id',
            'nilai_bobot' => 'required|numeric',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $bobotDosen = BobotDosenModel::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $bobotDosen
        ], 201);
    }

    /**
     * Menampilkan detail data bobot dosen
     */
    public function show($id)
    {
        $bobotDosen = BobotDosenModel::with(['user', 'bobotKegiatan'])->find($id);
        
        if (!$bobotDosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $bobotDosen
        ]);
    }

    /**
     * Mengupdate data bobot dosen
     */
    public function update(Request $request, $id)
    {
        $bobotDosen = BobotDosenModel::find($id);
        
        if (!$bobotDosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:m_user,user_id',
            'bobot_kegiatan_id' => 'exists:m_bobot_kegiatan,bobot_kegiatan_id',
            'nilai_bobot' => 'numeric',
            'waktu_mulai' => 'date',
            'waktu_selesai' => 'date|after:waktu_mulai'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $bobotDosen->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $bobotDosen
        ]);
    }

    /**
     * Menghapus data bobot dosen
     */
    public function destroy($id)
    {
        $bobotDosen = BobotDosenModel::find($id);
        
        if (!$bobotDosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $bobotDosen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}