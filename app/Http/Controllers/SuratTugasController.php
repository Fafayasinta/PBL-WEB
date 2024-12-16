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

    public function surat_ajax(Request $request, $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'surat_tugas' => 'nullable|file|mimes:pdf|max:2048' // Validasi khusus untuk file PDF
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        // Temukan kegiatan berdasarkan kegiatan_id
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan.',
            ]);
        }

        // Menyimpan file surat tugas jika ada file yang diupload
        $suratTugasPath = null;
        if ($request->hasFile('surat_tugas') && $request->file('surat_tugas')->isValid()) {
            $suratTugas = $request->file('surat_tugas');
            $filename = time() . '_' . $suratTugas->getClientOriginalName(); // Nama file unik
            $destinationPath = public_path('storage/surat_tugas'); // Folder tujuan di `public/storage/surat_tugas`

            // Membuat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Memindahkan file ke folder tujuan
            $suratTugas->move($destinationPath, $filename);
            $suratTugasPath = 'storage/surat_tugas/' . $filename; // Path relatif untuk disimpan ke database
        }

        // Menyimpan data surat tugas ke dalam kegiatan yang sudah ada
        $kegiatan->surat_tugas = $suratTugasPath;
        $kegiatan->save();

        // Mengembalikan response sukses
        return response()->json([
            'status' => true,
            'message' => 'Surat Tugas berhasil diupload dan kegiatan berhasil diperbarui.'
        ]);
    }

    return redirect('/kegiatanjti/' . $id . '/show/');
}
}