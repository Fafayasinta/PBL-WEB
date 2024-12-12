<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $activeMenu = 'profile';
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['Home', 'Profile']
        ];
        switch(auth()->user()->level->level_kode){
            case('ADMIN'):
                $redirect =  'admin';
                break;
            case('PIMPINAN'):
                $redirect =  'pimpinan';
                break;
            case('DOSEN'):
                $redirect=  'dosen';
                break;        
        }
        return view($redirect . '.profile.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'profile' => auth()->user()
        ]);
    }

    public function update(Request $request, $profile)
{
    // Validasi input
    $rules = [
        'username'  => 'required|string|min:3|unique:m_user,username,' . $profile . ',user_id',
        'nama'      => 'required|string|max:100',
        'password'  => 'nullable|min:5',
        'nip'       => 'required|string|max:50|unique:m_user,nip,' . $profile . ',user_id',
        'email'     => 'required|string|unique:m_user,email,' . $profile . ',user_id',
        'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi foto_profil
    ];

    // Melakukan validasi
    $validator = Validator::make($request->all(), $rules);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mencari data pengguna berdasarkan ID
    $user = UserModel::findOrFail($profile);

    // Mengupdate data pengguna
    $user->username = $request->username;
    $user->nama = $request->nama;
    $user->nip = $request->nip;
    $user->email = $request->email;

    // Update password jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Menyimpan foto profil jika ada file yang diupload
    if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()) {
        // Menghapus foto profil lama jika ada
        if ($user->foto_profil && Storage::exists($user->foto_profil)) {
            Storage::delete($user->foto_profil);
        }

        // Upload foto profil baru
        $fotoProfil = $request->file('foto_profil');
        $fotoProfilPath = $fotoProfil->store('public/foto_profil');
        $user->foto_profil = $fotoProfilPath; // Menyimpan path foto ke database
    }

    // Menyimpan perubahan
    $user->save();

    // Redirect ke halaman profil setelah update
    return redirect()->route('profile.index')->with('success', 'Data Pengguna berhasil diperbarui');
}
}
