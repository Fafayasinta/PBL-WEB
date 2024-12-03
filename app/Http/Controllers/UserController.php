<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = UserModel::all();
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function show($id)
    {
        $user = UserModel::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:m_user,username|max:255',
            'password' => 'required|min:6',
            'nama' => 'required|max:100',
            'nip' => 'required|max:20',
            'role' => ['required', Rule::in(['ADMIN', 'PIMPINAN', 'DOSEN'])],
            'foto_profil' => 'nullable|image|max:2048' // max 2MB
        ]);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            $validated['foto_profil'] = $path;
        }

        $user = UserModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'data' => $user
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'username' => ['required', Rule::unique('m_user')->ignore($id, 'user_id'), 'max:255'],
            'password' => 'nullable|min:6',
            'nama' => 'required|max:100',
            'nip' => 'required|max:20',
            'role' => ['required', Rule::in(['ADMIN', 'PIMPINAN', 'DOSEN'])],
            'foto_profil' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && $user->foto_profil != 'default-profile.jpg') {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            $validated['foto_profil'] = $path;
        }

        // Update password hanya jika ada input password baru
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = UserModel::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

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