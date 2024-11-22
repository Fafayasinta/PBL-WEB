<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Halaman login
    public function login()
    {
        if (Auth::check()) {
            return redirect('/'); // Redirect jika sudah login
        }
        return view('auth.login');
    }

    // Proses login
    public function postlogin(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        $redirectUrl = '/';
        switch ($user->level->level_kode ?? '') {
            case 'ADMIN':
                $redirectUrl = '/admin';
                break;
            case 'PIMPINAN':
                $redirectUrl = '/pimpinan';
                break;
            case 'DOSEN':
                $redirectUrl = '/dosen';
                break;
        }

        return response()->json([
            'status' => true,
            'message' => 'Login Berhasil',
            'redirect' => url($redirectUrl),
        ]);
    }

    return response()->json([
        'status' => false,
        'message' => 'Login Gagal. Username atau password salah.',
    ]);
}

    // Halaman registrasi
    public function register()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('auth.register')->with('level', $level);
    }

    // Proses registrasi
    public function postRegister(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'level_id' => 'required|integer|exists:m_level,level_id',
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        // Proses penyimpanan user baru
        $data = $request->all();
        $data['password'] = Hash::make($request->password); // Hash password
        UserModel::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Registrasi Berhasil',
            'redirect' => url('login'),
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
