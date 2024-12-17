<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Menampilkan daftar notifikasi
     */
    public function index()
    {
        $user = auth()->user()->user_id;
        $notifikasi = NotifikasiModel::with('user')->where('user_id',$user)->latest('created_at')->get();
        return response()->json([
            'status' => 'success',
            'data' => $notifikasi
        ]);
    }

    /**
     * Menyimpan notifikasi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $notifikasi = NotifikasiModel::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Notifikasi berhasil dibuat',
            'data' => $notifikasi
        ], 201);
    }

    /**
     * Menampilkan detail notifikasi
     */
    public function show($id)
    {
        $notifikasi = NotifikasiModel::with('user')->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $notifikasi
        ]);
    }

    /**
     * Memperbarui notifikasi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'string|max:255',
            'deskripsi' => 'string'
        ]);

        $notifikasi = NotifikasiModel::findOrFail($id);
        $notifikasi->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Notifikasi berhasil diperbarui',
            'data' => $notifikasi
        ]);
    }

    /**
     * Menghapus notifikasi
     */
    public function destroy($id)
    {
        $notifikasi = NotifikasiModel::findOrFail($id);
        $notifikasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Notifikasi berhasil dihapus'
        ]);
    }
}