<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKegiatanModel;
use App\Models\KegiatanModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Http\Request;

class AnggotaKegiatanController extends Controller
{
    public function create_ajax()
    {
        $kegiatan = KegiatanModel::select('kegiatan_id', 'nama_kegiatan')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        
        return view('admin.anggota.create_ajax')->with([
            'user' => $user,
            'kegiatan' => $kegiatan
        ]);
    }

    public function store_ajax(Request $request)
    {

        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kegiatan_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'jabatan' => [
                    'required',
                    ValidationRule::in(['PIC', 'Sekretaris', 'Bendahara', 'Anggota']),
                ],
                'skor' => 'required|numeric|between:0,9999.99', // Validasi skor sebagai angka desimal
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            AnggotaKegiatanModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data Jenis Kegiatan berhasil disimpan'
            ]);
        }
        return redirect('/kegiatanjti');
    }

    public function show_ajax(string $id){
        $anggota = AnggotaKegiatanModel::find($id);

        return view('admin.anggota.show_ajax', ['anggota' => $anggota]);
    }

    public function edit_ajax(string $id)
    {
        $kegiatan = KegiatanModel::select('kegiatan_id', 'nama_kegiatan')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $anggota = AnggotaKegiatanModel::find($id);

        return view('admin.anggota.edit_ajax', [
            'anggota' => $anggota,
            'kegiatan' => $kegiatan,
            'user' => $user
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kegiatan_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'jabatan' => [
                    'required',
                    ValidationRule::in(['PIC', 'Sekretaris', 'Bendahara', 'Anggota']),
                ],
                'skor' => 'required|numeric|between:0,9999.99', // Validasi skor sebagai angka desimal
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error
                ]);
            }

            $check = AnggotaKegiatanModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect(url('/kegiatanjti/' . $id->kegiatan_id . '/show'));
    }

    public function confirm_ajax(string $id)
    {
        $anggota = AnggotaKegiatanModel::find($id);

        return view('admin.anggota.confirm_ajax', ['anggota' => $anggota]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $anggota = AnggotaKegiatanModel::find($id);

            if ($anggota) {
                $anggota->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
            return redirect(url('/kegiatanjti/' . $id->kegiatan_id . '/show'));
        }
    }
}
