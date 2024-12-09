<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PimpinanAPIController extends Controller
{
    /**
     * Menampilkan daftar kegiatan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kegiatan = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'pic', 'progres', 'keterangan');

        // Filter berdasarkan nama_kegiatan (jika ada di request)
        if ($request->has('nama_kegiatan') && $request->nama_kegiatan != '') {
            $kegiatan->where('nama_kegiatan', 'like', '%' . $request->nama_kegiatan . '%');
        }

        // Mengambil data kegiatan dan mengembalikannya sebagai JSON
        return response()->json([
            'status' => true,
            'data' => $kegiatan->get()
        ], 200);
    }

    /**
     * Menambahkan kegiatan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_mulai'   => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'pic'            => 'required|string|max:255',
            'progres'        => 'required|numeric|min:0|max:100',
            'keterangan'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Menyimpan kegiatan baru
        $kegiatan = KegiatanModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kegiatan berhasil ditambahkan',
            'data' => $kegiatan
        ], 201);
    }

    /**
     * Menampilkan detail kegiatan berdasarkan ID.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $kegiatan
        ], 200);
    }

    /**
     * Mengupdate kegiatan berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan'
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required|string|max:255',
            'waktu_mulai'   => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'pic'            => 'required|string|max:255',
            'progres'        => 'required|numeric|min:0|max:100',
            'keterangan'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Mengupdate data kegiatan
        $kegiatan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kegiatan berhasil diperbarui',
            'data' => $kegiatan
        ], 200);
    }

    /**
     * Menghapus kegiatan berdasarkan ID.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan'
            ], 404);
        }

        // Menghapus kegiatan
        $kegiatan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kegiatan berhasil dihapus'
        ], 200);
    }
}
