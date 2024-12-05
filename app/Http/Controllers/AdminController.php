<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use App\Models\UserModel;
use App\Models\DokumenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung total berdasarkan status
        $totalSelesai = KegiatanModel::where('status', 'Selesai')->count();
        $totalProgress = KegiatanModel::where('status', 'Proses')->count(); 
        $totalBelumMulai = KegiatanModel::where('status', 'Belum Proses')->count();
        $totalDitunda = KegiatanModel::where('status', 'Ditunda')->count();

        // Ambil data kegiatan
        $kegiatan = KegiatanModel::with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalSelesai', 
            'totalProgress',
            'totalBelumMulai', 
            'totalDitunda',
            'kegiatan'
        ));
    }

    // Modifikasi dari user.blade.php yang diberikan
    public function manageUsers()
    {
        $users = UserModel::where('user_id', '!=', auth()->id())->get();
        return view('admin.users', compact('users')); 
    }

    public function updateUser(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'nip' => ['required', Rule::unique('m_user')->ignore($user->user_id, 'user_id')],
        ]);

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diperbarui'
        ]);
    }

    public function deleteUser($id)
    {
        $user = UserModel::findOrFail($id);
        
        // Hapus foto profil jika bukan default
        if ($user->foto_profil && $user->foto_profil != 'default-profile.jpg') {
            Storage::disk('public')->delete($user->foto_profil);
        }
        
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
}