<?php

namespace App\Http\Controllers;

use App\Models\DokumenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen
     */
    public function index()
    {
        $dokumen = DokumenModel::with('user')->get();
        return response()->json($dokumen);
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

        return response()->json([
            'message' => 'Dokumen berhasil ditambahkan',
            'data' => $dokumen
        ], 201);
    }

    /**
     * Menampilkan detail dokumen
     */
    public function show(DokumenModel $dokumen)
    {
        return response()->json($dokumen->load('user'));
    }

    /**
     * Mengupdate dokumen
     */
    public function update(Request $request, DokumenModel $dokumen)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'sometimes|string|max:255',
            'jenis_dokumen' => 'sometimes|string|max:255',
            'is_verified' => 'sometimes|boolean'
        ]);

        $dokumen->update($validated);

        return response()->json([
            'message' => 'Dokumen berhasil diperbarui',
            'data' => $dokumen
        ]);
    }

    /**
     * Menghapus dokumen
     */
    public function destroy(DokumenModel $dokumen)
    {
        $dokumen->delete();

        return response()->json([
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }

    /**
     * Verifikasi dokumen
     */
    public function verify(DokumenModel $dokumen)
    {
        $dokumen->update(['is_verified' => true]);

        return response()->json([
            'message' => 'Dokumen berhasil diverifikasi',
            'data' => $dokumen
        ]);
    }
}