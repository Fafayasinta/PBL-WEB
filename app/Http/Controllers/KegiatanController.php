<?php
// app/Http/Controllers/KegiatanController.php

namespace App\Http\Controllers;

use App\Models\AnggotaKegiatanModel;
use App\Models\BobotKegiatanModel;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_kegiatan_id' => 'required|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'nama_kegiatan' => 'required|string|max:200',
            'pic_id' => 'required|exists:m_user,user_id',
            'anggota_ids' => 'required|array',
            'anggota_ids.*' => 'exists:m_user,user_id|different:pic_id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'deadline' => 'required|date|after:waktu_mulai',
            'progres' => 'required|numeric|min:0|max:100',
            'status' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
            'beban_kegiatan_id' => 'required|exists:m_beban_kegiatan,beban_kegiatan_id',
        ]);

        DB::beginTransaction();
        try {
            // Simpan kegiatan
            $kegiatan = KegiatanModel::create([
                'user_id' => auth()->id(),
                'kategori_kegiatan_id' => $validated['kategori_kegiatan_id'],
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'pic' => $validated['pic_id'], // Menggunakan pic_id sebagai pic
                'waktu_mulai' => $validated['waktu_mulai'],
                'waktu_selesai' => $validated['waktu_selesai'],
                'deadline' => $validated['deadline'],
                'progres' => $validated['progres'],
                'status' => $validated['status'],
                'deskripsi' => $validated['deskripsi'],
                'beban_kegiatan_id' => $validated['beban_kegiatan_id'],
            ]);

            // Simpan PIC sebagai anggota
            AnggotaKegiatanModel::create([
                'kegiatan_id' => $kegiatan->kegiatan_id,
                'user_id' => $validated['pic_id'],
                'jabatan' => 'PIC',
                'skor' => 5.00
            ]);

            // Simpan anggota-anggota lain
            foreach ($request->anggota_ids as $anggotaId) {
                AnggotaKegiatanModel::create([
                    'kegiatan_id' => $kegiatan->kegiatan_id,
                    'user_id' => $anggotaId,
                    'jabatan' => 'Anggota',
                    'skor' => 3.00
                ]);
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kegiatan created successfully'
                ]);
            }

            return redirect()->route('kegiatan.index')
                ->with('success', 'Kegiatan created successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error creating kegiatan: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $Kegiatans = KegiatanModel::latest()->get();
        return view('Kegiatan.index', compact('Kegiatan'));
    }

    public function create()
    {
        return view('Kegiatans.form');
    }

    public function edit(KegiatanModel $kegiatan)
    {
        $kategori = KategoriKegiatanModel::all();
        $bebanKerja = BobotKegiatanModel::all();

        return view('kegiatan.edit', compact('kegiatan', 'kategori', 'bebanKerja'));
    }

    public function destroy(KegiatanModel $Kegiatan)
    {
        $Kegiatan->delete();
        return redirect()->route('Kegiatan.index')
            ->with('success', 'Kegiatan deleted successfully');
    }
    public function detail($id)
    {
        $kegiatan = KegiatanModel::with(['kategori', 'anggota.user'])->findOrFail($id);
        return view('detail', compact('kegiatan'));
    }
    public function update(Request $request, KegiatanModel $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:200',
            'kategori_kegiatan_id' => 'required|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'pic' => 'required|string|max:100',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'deadline' => 'required|date|after:waktu_mulai',
            'status' => 'required|string|max:20',
            'beban_kegiatan_id' => 'required|exists:m_beban_kegiatan,beban_kegiatan_id',
            'deskripsi' => 'required|string',
        ]);

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate');
    }
}
