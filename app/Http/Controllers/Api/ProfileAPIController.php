<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileAPIController extends Controller
{
    /**
     * Menampilkan profil pengguna yang sedang login.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengembalikan data pengguna dalam format JSON
        return response()->json([
            'status' => true,
            'data' => $user,
        ], 200);
    }

    /**
     * Memperbarui profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed', // opsional, jika ingin mengganti password
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Memperbarui nama dan email pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan ke database
        $user->save();

        // Mengembalikan response sukses
        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully!',
            'data' => $user,
        ], 200);
    }
}
