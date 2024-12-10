<?php

namespace App\Http\Controllers;

use App\Models\SuratTugasModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use PDF;
use App\Models\KegiatanAgendaModel;
use App\Models\KegiatanModel;
use App\Models\UserModel;
use App\Models\AnggotaKegiatanModel;

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
    $suratTugas = SuratTugasModel::findOrFail($id);
    $kegiatan = KegiatanModel::find($suratTugas->kegiatan_id);
    $agenda = KegiatanAgendaModel::where('kegiatan_id', $suratTugas->kegiatan_id)->get();
    $dosen = AnggotaKegiatanModel::where('kegiatan_id', $suratTugas->kegiatan_id)->get();

    $suratTugas->load('user');

    $pdf = FacadePdf::loadView('pimpinan.kegiatanjti.surat-tugas', compact('suratTugas', 'kegiatan', 'agenda', 'dosen'));
    return $pdf->download('surat-tugas-' . $suratTugas->nomor_surat . '.pdf');
}

}