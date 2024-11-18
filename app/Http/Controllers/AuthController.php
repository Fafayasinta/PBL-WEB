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
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }
    public function postlogin(Request $request)
{
    // Proses login dengan AJAX atau JSON request
    if ($request->ajax() || $request->wantsJson()) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Mendapatkan data pengguna yang sedang login
            $user = Auth::user();

            // Tentukan redirect berdasarkan level pengguna
            $redirectUrl = '/'; // Default redirect
            switch ($user->level->level_kode) {
                case 'ADMIN':
                    $redirectUrl = '/admin';
                    break;
                case 'PIMPINAN':
                    $redirectUrl = '/pimpinan';
                    break;
                case 'DOSEN':
                    $redirectUrl = '/dosen';
                    break;
                default:
                    $redirectUrl = '/'; // Jika tidak memiliki level yang valid
            }

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url($redirectUrl),
            ]);
        }

        // Jika login gagal
        return response()->json([
            'status' => false,
            'message' => 'Login Gagal. Username atau password salah.',
        ]);
    }

    // Proses login tanpa AJAX
    return redirect('login');
}

    public function register()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('auth.register')->with('level', $level);
    }
    public function postRegister(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            // Hash password sebelum disimpan
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            // Simpan data user
            UserModel::create($data);
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
                'redirect' => url('login') // Redirect ke halaman login
            ]);
        }
        // Jika bukan AJAX, arahkan ke halaman login
        return redirect('login')->with('success', 'Registrasi berhasil!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}