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
    

}