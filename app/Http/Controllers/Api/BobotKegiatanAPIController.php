<?php

namespace App\Http\Controllers;

use App\Models\BobotKegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BobotKegiatanAPIController extends Controller
{
    /**
     * Menampilkan daftar bobot kegiatan
     */
    public function index()
    {
        $bobotKegiatan = BobotKegiatanModel::all();
        return $this->successResponse('Data berhasil diambil', $bobotKegiatan);
    }

    /**
     * Menyimpan bobot kegiatan baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), BobotKegiatanModel::$rules);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $bobotKegiatan = BobotKegiatanModel::create($request->all());
        return $this->successResponse('Data berhasil ditambahkan', $bobotKegiatan, 201);
    }

    /**
     * Menampilkan detail bobot kegiatan
     */
    public function show($id)
    {
        $bobotKegiatan = BobotKegiatanModel::find($id);

        if (!$bobotKegiatan) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        return $this->successResponse('Data berhasil ditemukan', $bobotKegiatan);
    }

    /**
     * Mengupdate bobot kegiatan
     */
    public function update(Request $request, $id)
    {
        $bobotKegiatan = BobotKegiatanModel::find($id);

        if (!$bobotKegiatan) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $rules = BobotKegiatanModel::$rules;
        $rules['nama_bobot'] = 'required|string|max:100|unique:m_bobot_kegiatan,nama_bobot,' . $id . ',bobot_kegiatan_id';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $bobotKegiatan->update($request->all());
        return $this->successResponse('Data berhasil diupdate', $bobotKegiatan);
    }

    /**
     * Menghapus bobot kegiatan
     */
    public function destroy($id)
    {
        $bobotKegiatan = BobotKegiatanModel::find($id);

        if (!$bobotKegiatan) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $bobotKegiatan->delete();
        return $this->successResponse('Data berhasil dihapus', null);
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
