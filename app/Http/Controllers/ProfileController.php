<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\NotifikasiModel;
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
        $user = auth()->user()->user_id;
        $notifikasi = NotifikasiModel::with('user')->where('user_id',$user)->latest('created_at')->get();
    
        return view($redirect . '.profile.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'notifikasi'=> $notifikasi,
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

        return view($redirect .'.profile.edit_ajax', [
            'profile' => $profile
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|min:3|max:100',
            'username' => 'required|min:5|max:50',
            'email' => 'required|email',
            'nip' => 'required',
            'password' => 'nullable|min:6', // Hanya validasi jika ada password baru
        ]);
    
        // Temukan profile berdasarkan user_id
        $profile = UserModel::find($id);
    
        if ($profile) {
            // Update data lainnya
            $profile->nama = $validated['nama'];
            $profile->username = $validated['username'];
            $profile->email = $validated['email'];
            $profile->nip = $validated['nip'];
    
            // Jika password diisi, enkripsi dan simpan password baru
            if ($request->has('password') && !empty($request->password)) {
                $profile->password = Hash::make($request->password);
            }
    
            // Simpan data
            $profile->save();
    
            // Mengembalikan response sukses
            return response()->json([
                'status' => true,
                'message' => 'Profil berhasil diperbarui.',
            ]);
        }
    
        // Jika profile tidak ditemukan
        return response()->json([
            'status' => false,
            'message' => 'Pengguna tidak ditemukan.',
        ]);
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

