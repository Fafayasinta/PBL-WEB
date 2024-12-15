<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
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

    public function edit_ajax(string $id)
    {
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
        $profile = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view($redirect .'.profile.edit_ajax', [
            'profile' => $profile,
            'level' => $level
        ]);
    }

public function update_ajax(Request $request, $id)
{
    // cek apakah request dari ajax
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'level_id' => 'required|numeric',
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:m_user,user_id,' . $id . ',user_id',
            'password' => 'required|string|min:5',
            'email' => 'required|string|max:50|unique:m_user,user_id,' . $id . ',user_id',
            'nip' => 'required|string|max:50|unique:m_user,user_id,' . $id . ',user_id',
        ];

        // Validasi input
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,    // response json: true: berhasil, false: gagal
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()  // menunjukkan field mana yang error
            ]);
        }

        // Ambil data profile yang ingin diupdate
        $check = UserModel::find($id);

        if ($check) {
            // Jika password baru diberikan, kita hash password tersebut
            if (!empty($request->password)) {
                $request->merge(['password' => Hash::make($request->password)]);  // Hash password baru
            } else {
                // Jika password tidak diubah, biarkan password yang lama
                $request->merge(['password' => $check->password]);
            }

            // Update data pengguna
            $check->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    return redirect('/profile');
}

public function edit_foto(string $id)
{
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
    $user = UserModel::find($id);
    $level = LevelModel::select('level_id', 'level_nama')->get();
    return view($redirect.'.profile.edit_foto', ['user' => $user, 'level' => $level]);
}

public function update_foto(Request $request, $id)
{
    $rules = [
        'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal.',
            'msgField' => $validator->errors()
        ]);
    }

    $user = UserModel::find($id);

    if ($user) {
        if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && file_exists(public_path('storage/foto_profil/' . basename($user->foto_profil)))) {
                unlink(public_path('storage/foto_profil/' . basename($user->foto_profil)));
            }

            // Simpan foto baru
            $foto = $request->file('foto_profil');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $path = public_path('storage/foto_profil'); // Path tujuan langsung di folder public
            $foto->move($path, $filename); // Memindahkan file ke path tujuan

            // Update path foto di database
            $user->update([
                'foto_profil' => 'storage/foto_profil/' . $filename
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Foto berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Foto tidak valid atau tidak ditemukan dalam request'
            ]);
        }
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data pengguna tidak ditemukan'
        ]);
    } 
    return redirect('/profile');
}
}

