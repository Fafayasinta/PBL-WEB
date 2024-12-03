<?php
// app/Http/Controllers/KegiatanController.php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_kegiatan_id' => 'required|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'nama_kegiatan' => 'required|string|max:200',
            'pic' => 'required|string|max:100',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'deadline' => 'required|date|after:waktu_mulai',
            'progres' => 'required|numeric|min:0|max:100',
            'status' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);

        $Kegiatan = KegiatanModel::create([
            'user_id' => auth()->id(), 
            'kategori_kegiatan_id' => $validated['kategori_kegiatan_id'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'pic' => $validated['pic'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'deadline' => $validated['deadline'],
            'progres' => $validated['progres'],
            'status' => $validated['status'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('Kegiatans.index')
            ->with('success', 'Kegiatan created successfully.');
    }

    public function index()
    {
        $Kegiatans = KegiatanModel::latest()->get();
        return view('Kegiatan.index', compact('Kegiatans'));
    }
    
    public function show($id)
{
    $kegiatan = KegiatanModel::with(['kategori', 'anggota.user'])->find($id);

    if (!$kegiatan) {
        return redirect()->route('Kegiatan.index')->with('error', 'Kegiatan tidak ditemukan.');
    }

    return view('Kegiatan.show', compact('kegiatan'));
}

    public function create()
    {
        return view('Kegiatans.form');
    }

    public function edit(KegiatanModel $Kegiatan)
    {
        return view('Kegiatans.form', compact('Kegiatan'));
    }

    public function destroy(KegiatanModel $Kegiatan)
    {
        $Kegiatan->delete();
        return redirect()->route('Kegiatan.index')
            ->with('success', 'Kegiatan deleted successfully');
    }
}
