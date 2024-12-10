<?php

namespace App\Http\Controllers;

use App\Models\DokumenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenAPIController extends Controller
{
    /**
     * Menampilkan daftar dokumen
     */
    public function index()
    {
        $dokumen = DokumenModel::with('user')->get();
        return $this->successResponse('Data dokumen berhasil diambil', $dokumen);
    }

    /**
     * Menyimpan dokumen baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'jenis_dokumen' => 'required|string|max:255',
        ]);

        $dokumen = DokumenModel::create([
            'user_id' => Auth::id(),
            'nama_dokumen' => $validated['nama_dokumen'],
            'jenis_dokumen' => $validated['jenis_dokumen'],
            'uploaded_at' => now(),
            'is_verified' => false
        ]);

        return $this->successResponse('Dokumen berhasil ditambahkan', $dokumen, 201);
    }

    /**
     * Menampilkan detail dokumen
     */
    public function show(DokumenModel $dokumen)
    {
        return $this->successResponse('Detail dokumen berhasil diambil', $dokumen->load('user'));
    }

    /**
     * Mengupdate dokumen
     */
    public function update(Request $request, DokumenModel $dokumen)
    {
        $this->authorize('update', $dokumen);

        $validated = $request->validate([
            'nama_dokumen' => 'sometimes|string|max:255',
            'jenis_dokumen' => 'sometimes|string|max:255',
            'is_verified' => 'sometimes|boolean'
        ]);

        $dokumen->update($validated);

        return $this->successResponse('Dokumen berhasil diperbarui', $dokumen);
    }

    /**
     * Menghapus dokumen
     */
    public function destroy(DokumenModel $dokumen)
    {
        $this->authorize('delete', $dokumen);

        $dokumen->delete();

        return $this->successResponse('Dokumen berhasil dihapus');
    }

    /**
     * Verifikasi dokumen
     */
    public function verify(DokumenModel $dokumen)
    {
        $dokumen->update(['is_verified' => true]);

        return $this->successResponse('Dokumen berhasil diverifikasi', $dokumen);
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
