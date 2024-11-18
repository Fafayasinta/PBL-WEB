<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatanModel;
use Illuminate\Http\Request;

class KategoriKegiatanController extends Controller
{
    public function index()
    {
        $kategori = KategoriKegiatanModel::all();
        return view('kategori_kegiatan.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_kegiatan.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,nama_kategori',
            'deskripsi' => 'required|string'
        ]);

        KategoriKegiatanModel::create($validated);

        return redirect()->route('kategori-kegiatan.index')
            ->with('success', 'Kategori kegiatan berhasil ditambahkan');
    }

    public function edit(KategoriKegiatanModel $kategoriKegiatan)
    {
        return view('kategori_kegiatan.form', compact('kategoriKegiatan'));
    }

    public function update(Request $request, KategoriKegiatanModel $kategoriKegiatan)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,nama_kategori,'.$kategoriKegiatan->kategori_kegiatan_id.',kategori_kegiatan_id',
            'deskripsi' => 'required|string'
        ]);

        $kategoriKegiatan->update($validated);

        return redirect()->route('kategori-kegiatan.index')
            ->with('success', 'Kategori kegiatan berhasil diperbarui');
    }

    public function destroy(KategoriKegiatanModel $kategoriKegiatan)
    {
        // Cek apakah kategori masih digunakan di tabel kegiatan
        if ($kategoriKegiatan->kegiatan()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dalam kegiatan');
        }

        $kategoriKegiatan->delete();
        return redirect()->route('kategori-kegiatan.index')
            ->with('success', 'Kategori kegiatan berhasil dihapus');
    }
}