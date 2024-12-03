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
        // Ambil semua data user kecuali admin yang sedang login
        $users = UserModel::where('user_id', '!=', auth()->id())->get();
        return view('user', compact('users'));
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
    public function contactsView()
    {
        $users = UserModel::all();
        return view('contacts', compact('users'));
    }

    // New method for individual user profile view
    public function profileView($id)
    {
        $user = UserModel::findOrFail($id);
        return view('user-profile', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Dapatkan data user yang login dalam bentuk model UserModel
        $user = UserModel::find(auth()->id());

        $validated = $request->validate([
            'nama' => 'required|max:100',
            'username' => ['required', Rule::unique('m_user')->ignore($user->user_id, 'user_id')],
            'email' => ['required', 'email', Rule::unique('m_user')->ignore($user->user_id, 'user_id')],
            'nip' => ['required', Rule::unique('m_user')->ignore($user->user_id, 'user_id')],
            'password' => 'nullable|min:6',
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
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
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
