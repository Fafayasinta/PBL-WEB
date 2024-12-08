<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BobotDosenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BobotDosenAPIController extends Controller
{
    /**
     * Menampilkan semua data bobot dosen
     */
    public function index()
    {
        $bobotDosen = BobotDosenModel::with(['user', 'bobotKegiatan'])->get();
        return $this->successResponse('Data berhasil diambil', $bobotDosen);
    }

    /**
     * Menyimpan data bobot dosen baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $bobotDosen = BobotDosenModel::create($request->all());
        return $this->successResponse('Data berhasil disimpan', $bobotDosen, 201);
    }

    /**
     * Menampilkan detail data bobot dosen
     */
    public function show($id)
    {
        $bobotDosen = BobotDosenModel::with(['user', 'bobotKegiatan'])->find($id);
        if (!$bobotDosen) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        return $this->successResponse('Data berhasil ditemukan', $bobotDosen);
    }

    /**
     * Mengupdate data bobot dosen
     */
    public function update(Request $request, $id)
    {
        $bobotDosen = BobotDosenModel::find($id);
        if (!$bobotDosen) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), $this->rules(false));
        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $bobotDosen->update($request->all());
        return $this->successResponse('Data berhasil diperbarui', $bobotDosen);
    }

    /**
     * Menghapus data bobot dosen
     */
    public function destroy($id)
    {
        $bobotDosen = BobotDosenModel::find($id);
        if (!$bobotDosen) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $bobotDosen->delete();
        return $this->successResponse('Data berhasil dihapus', null);
    }

    /**
     * Aturan validasi
     */
    private function rules($isCreate = true)
    {
        $rules = [
            'user_id' => 'exists:m_user,user_id',
            'bobot_kegiatan_id' => 'exists:m_bobot_kegiatan,bobot_kegiatan_id',
            'nilai_bobot' => 'numeric',
            'waktu_mulai' => 'date',
            'waktu_selesai' => 'date|after:waktu_mulai',
        ];

        if ($isCreate) {
            $rules['user_id'] = 'required|' . $rules['user_id'];
            $rules['bobot_kegiatan_id'] = 'required|' . $rules['bobot_kegiatan_id'];
            $rules['nilai_bobot'] = 'required|' . $rules['nilai_bobot'];
            $rules['waktu_mulai'] = 'required|' . $rules['waktu_mulai'];
            $rules['waktu_selesai'] = 'required|' . $rules['waktu_selesai'];
        }

        return $rules;
    }

    /**
     * Helper untuk respons sukses
     */
    private function successResponse($message, $data = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Helper untuk respons error
     */
    private function errorResponse($message, $errors = null, $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
