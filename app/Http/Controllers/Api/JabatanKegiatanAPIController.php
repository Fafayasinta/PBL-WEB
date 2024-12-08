<?php

namespace App\Http\Controllers;

use App\Models\BobotJabatanModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;

class JabatanKegiatanAPIController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        return view('admin.jabatankegiatan.index', [
            'activeMenu' => 'jabatankegiatan',
            'breadcrumb' => (object) [
                'title' => 'Data Jabatan Kegiatan',
                'list' => ['Home', 'Jabatan Kegiatan'],
            ],
        ]);
    }

    /**
     * Menampilkan daftar data dalam format DataTables
     */
    public function list(Request $request)
    {
        $jabatankegiatan = BobotJabatanModel::query();

        return datatables()
            ->eloquent($jabatankegiatan)
            ->addIndexColumn()
            ->addColumn('action', function ($jabatankegiatan) {
                return view('admin.jabatankegiatan.partials.action-buttons', [
                    'id' => $jabatankegiatan->bobot_jabatan_id,
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Menampilkan form tambah data
     */
    public function create_ajax()
    {
        return view('admin.jabatankegiatan.create_ajax');
    }

    /**
     * Menyimpan data baru
     */
    public function store_ajax(Request $request)
    {
        return $this->saveData($request);
    }

    /**
     * Menampilkan data untuk diubah
     */
    public function edit_ajax(string $id)
    {
        $jabatankegiatan = BobotJabatanModel::findOrFail($id);

        return view('admin.jabatankegiatan.edit_ajax', compact('jabatankegiatan'));
    }

    /**
     * Memperbarui data
     */
    public function update_ajax(Request $request, string $id)
    {
        return $this->saveData($request, $id);
    }

    /**
     * Menghapus data
     */
    public function delete_ajax(Request $request, string $id)
    {
        $jabatankegiatan = BobotJabatanModel::find($id);

        if ($jabatankegiatan) {
            $jabatankegiatan->delete();

            return $this->successResponse('Data berhasil dihapus');
        }

        return $this->errorResponse('Data tidak ditemukan');
    }

    /**
     * Helper untuk menyimpan atau memperbarui data
     */
    private function saveData(Request $request, string $id = null)
    {
        $rules = [
            'cakupan_wilayah' => ['required', ValidationRule::in(['Luar Institusi', 'Institusi', 'Jurusan', 'Program Studi'])],
            'jabatan' => ['required', ValidationRule::in(['PIC', 'Sekretaris', 'Bendahara', 'Anggota'])],
            'skor' => 'required|numeric|between:0,9999.99',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal.', $validator->errors());
        }

        $data = $request->only(['cakupan_wilayah', 'jabatan', 'skor']);
        $jabatankegiatan = $id ? BobotJabatanModel::find($id) : new BobotJabatanModel();

        if ($id && !$jabatankegiatan) {
            return $this->errorResponse('Data tidak ditemukan.');
        }

        $jabatankegiatan->fill($data);
        $jabatankegiatan->save();

        return $this->successResponse('Data berhasil disimpan', $jabatankegiatan);
    }

    /**
     * Helper untuk respon sukses
     */
    private function successResponse($message, $data = null, $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Helper untuk respon error
     */
    private function errorResponse($message, $errors = null, $status = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
