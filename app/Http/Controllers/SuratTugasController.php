<?php

namespace App\Http\Controllers;

use App\Models\SuratTugasModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\KegiatanAgendaModel;
use App\Models\KegiatanModel;
use App\Models\UserModel;
use App\Models\AnggotaKegiatanModel;
use App\Models\BobotJabatanModel;
use Illuminate\Support\Facades\Validator;

class SuratTugasController extends Controller
{
    public function index()
    {
        $suratTugas = SuratTugasModel::with(['user', 'kegiatan'])->get();
        return view('surat-tugas.index', compact('suratTugas'));
    }

    public function create()
    {
        return view('surat-tugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'kegiatan_id' => 'required|exists:t_kegiatan,kegiatan_id',
            'nomor_surat' => 'required|string|unique:surat_tugas'
        ]);

        SuratTugasModel::create($validated);

        return redirect()->route('surat-tugas.index')
            ->with('success', 'Surat tugas berhasil dibuat');
    }

    public function show(SuratTugasModel $suratTugas)
    {
        return view('surat-tugas.show', compact('suratTugas'));
    }

    public function exportPDF($id)
    {
        set_time_limit(300);
        switch(auth()->user()->level->level_kode){
            case('ADMIN'):
                $redirect =  'admin';
                break;
            case('PIMPINAN'):
                $redirect =  'pimpinan';
                break;
            case('DOSEN'):
                $redirect =  'dosen';
                break;        
        }
    
        // Ambil objek kegiatan berdasarkan ID
        $kegiatan = KegiatanModel::find($id);
    
        // Pastikan kegiatan ditemukan sebelum melanjutkan
        if (!$kegiatan) {
            return redirect()->back()->with('error', 'Kegiatan tidak ditemukan.');
        }
    
        // Ambil data yang berkaitan dengan kegiatan
        $agenda = KegiatanAgendaModel::where('kegiatan_id', $kegiatan->kegiatan_id)->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $jabatan = BobotJabatanModel::select('bobot_jabatan_id', 'jabatan')->get();
        $dosen = AnggotaKegiatanModel::where('kegiatan_id', $kegiatan->kegiatan_id)
            ->with(['user', 'jabatan'])
            ->get();
       // dd($jabatan);
        // Buat file PDF
        $pdf = Pdf::loadView($redirect . '.kegiatanjti.surat_tugas', [
            'kegiatan' => $kegiatan,
            'user' => $user,
            'jabatan' => $jabatan,
            'agenda' => $agenda,
            'dosen' => $dosen,
        ]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari uri
        $pdf->render();
    
        // Stream PDF
        return $pdf->stream('Surat Pengantar ' . $kegiatan->kegiatan_nama . '.pdf');
    }

    public function upload_surat(string $id)
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
        $surat = KegiatanModel::find($id);

        return view($redirect .'.kegiatanjti.upload_surat_tugas', [
            'surat' => $surat
        ]);
    }

    public function update_surat(Request $request, $id)
{
    $rules = [
        'surat_tugas' => 'nullable|file|mimes:pdf|max:2048' // Validasi khusus untuk file PDF
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal.',
            'msgField' => $validator->errors()
        ]);
    }

    $surat = KegiatanModel::find($id);

    if ($surat) {
        if ($request->hasFile('surat_tugas') && $request->file('surat_tugas')->isValid()) {
            // Hapus file lama jika ada
            if ($surat->surat_tugas && file_exists(public_path('storage/surat_tugas/' . basename($surat->surat_tugas)))) {
                unlink(public_path('storage/surat_tugas/' . basename($surat->surat_tugas)));
            }

            // Simpan file baru
            $file = $request->file('surat_tugas');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('storage/surat_tugas'); // Path tujuan langsung di folder public
            $file->move($path, $filename); // Memindahkan file ke path tujuan

            // Update path surat_tugas di database
            $surat->surat_tugas = 'storage/surat_tugas/' . $filename;
            $surat->save(); // Jangan lupa simpan perubahan ke database

            return response()->json([
                'status' => true,
                'message' => 'Surat Tugas berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Surat tugas tidak valid atau tidak ditemukan dalam request'
            ]);
        }
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data kegiatan tidak ditemukan'
        ]);
    } 

}

public function upload_laporan(string $id)
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
        $laporan = KegiatanModel::find($id);

        return view($redirect .'.kegiatanjti.upload_laporan', [
            'laporan' => $laporan
        ]);
    }


    public function update_laporan(Request $request, $id)
{
    $rules = [
        'laporan' => 'nullable|file|mimes:pdf|max:2048' // Validasi khusus untuk file PDF
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal.',
            'msgField' => $validator->errors()
        ]);
    }

    $laporan = KegiatanModel::find($id);

    if ($laporan) {
        if ($request->hasFile('laporan') && $request->file('laporan')->isValid()) {
            // Hapus file lama jika ada
            if ($laporan->laporan && file_exists(public_path('storage/laporan/' . basename($laporan->laporan)))) {
                unlink(public_path('storage/laporan/' . basename($laporan->laporan)));
            }

            // Simpan file baru
            $file = $request->file('laporan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('storage/laporan'); // Path tujuan langsung di folder public
            $file->move($path, $filename); // Memindahkan file ke path tujuan

            // Update path surat_tugas di database
            $laporan->laporan = 'storage/laporan/' . $filename;
            $laporan->save(); // Jangan lupa simpan perubahan ke database

            return response()->json([
                'status' => true,
                'message' => 'File laporan berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'File laporan tidak valid atau tidak ditemukan dalam request'
            ]);
        }
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Data kegiatan tidak ditemukan'
        ]);
    } 

}

}