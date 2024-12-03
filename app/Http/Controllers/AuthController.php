<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Cek kredensial
            $user = UserModel::where('username', $request->username)->first();
            
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Username atau password salah'
                ], 401);
            }

            // Login user
            Auth::login($user);

            // Set session
            if ($user->foto_profil) {
                session(['profile_img_path' => $user->foto_profil]);
            }
            session(['user_id' => $user->user_id]);
            session(['level_id' => $user->level_id]);

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url('/home'),
                'user' => $user->load('level') // Load relasi level
            ], 200);

        } catch (\Exception $e) {
            Log::error('Login Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return response()->json([
                'status' => true,
                'message' => 'Logout berhasil',
                'redirect' => url('/login')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Logout Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat logout: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showLinkRequestForm()
{
    return view('login.reset');
}

/**
 * Mengirim email reset password
 */
public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    try {
        $user = UserModel::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan dalam sistem.'
            ]);
        }

        // Generate token reset password
        $token = Str::random(60);
        
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Kirim email 
        Mail::send('emails.reset_password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        }); 

        return back()->with('status', 'Link reset password telah dikirim ke email Anda!');

    } catch (\Exception $e) {
        Log::error('Reset Password Error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return back()->withErrors([
            'email' => 'Terjadi kesalahan saat memproses permintaan reset password.'
        ]);
    }
}
}