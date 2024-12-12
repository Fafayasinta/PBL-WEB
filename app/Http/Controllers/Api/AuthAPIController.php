<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
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



class AuthAPIController extends Controller
{

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                session([
                    'user_id' => Auth::user()->user_id
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    
    public function store(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id'  => 'required|integer',
                'username'  => 'required|string|min:3|unique:m_user,username',
                'nama'      => 'required|string|max:100',
                'password'  => 'required|min:5',
                'nip'       => 'required|string|max:50|unique:m_user,nip',
                'email'     => 'required|string|unique:m_user,email'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            UserModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data user berhasil disimpan',
            ]);
        }
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(
            [
                'status' => true,
                'message' => 'Logout Berhasil'
            ]
        );
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