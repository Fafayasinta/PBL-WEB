<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BebanKegiatanModel;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use App\Models\TahunModel;
use App\Models\UserModel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\Models\NotifikasiModel;
use Illuminate\Support\Facades\Auth; // Pastikan Auth diimpor


class KegiatanNonJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatannonjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan Non JTI',
            'list' => ['Home', 'kegiatannonjti']
        ];
        $user = auth()->user()->user_id;
        $notifikasi = NotifikasiModel::with('user')->where('user_id',$user)->latest('created_at')->get();
    
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

        return view($redirect.'.kegiatannonjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'notifikasi'=> $notifikasi,
        ]);
    }

    public function list(Request $request)
    {
        $loggedInUser = Auth::user(); // Ambil pengguna yang login
        $kegiatannonjti = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'user_id', 'kategori_kegiatan_id', 'cakupan_wilayah', 'waktu_mulai', 'beban_kegiatan_id')
            ->with('user')
            ->with('kategori')
            ->with('beban')
            ->whereIn('kategori_kegiatan_id', [3]);

    //  if ($request->nama_kategori) {
    //         $kegiatannonjti->whereHas('kategori_kegiatan', function ($query) use ($request) {
    //             $query->where('nama_kategori', $request->nama_kategori);
    //      });
    //  }

    //  if ($request->status) {
    //      $kegiatannonjti->where('status', $request->status);
    //  }
        // Cek level pengguna login
    if ($loggedInUser->level->level_kode == 'DOSEN') {
        // Jika level pengguna adalah DOSEN, filter kegiatan berdasarkan user_id
        $kegiatannonjti->whereHas('anggota', function ($query) use ($loggedInUser) {
            $query->where('user_id', $loggedInUser->user_id);
        });
    }
        return DataTables::of($kegiatannonjti)
        ->addIndexColumn()
        ->addColumn('action', function ($kegiatannonjti) {
            $btn  = '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }

    public function show_ajax(string $id)
    {
        $kegiatannonjti = KegiatanModel::find($id);
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
        return view($redirect.'.kegiatannonjti.show_ajax', ['kegiatannonjti' => $kegiatannonjti]);
    }

    public function create_ajax()
    {   switch(auth()->user()->level->level_kode){
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
        $kategori = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori')
        ->whereIn('kategori_kegiatan_id', [3])
        ->get();

        $beban = BebanKegiatanModel::select('beban_kegiatan_id', 'nama_beban')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $tahun = TahunModel::select('tahun_id', 'tahun')->get();

        return view($redirect.'.kegiatannonjti.create_ajax')->with([
            'kategori' => $kategori,
            'beban' => $beban,
            'user' => $user,
            'tahun' => $tahun
        ]);
    }

    public function store_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'user_id' => 'required|integer|exists:m_user,user_id',
            'tahun_id' => 'required|integer|exists:m_tahun,tahun_id',
            'kategori_kegiatan_id' => 'required|integer|exists:m_kategori_kegiatan,kategori_kegiatan_id',
            'beban_kegiatan_id' => 'required|integer|exists:m_beban_kegiatan,beban_kegiatan_id',
            'nama_kegiatan' => 'required|string|max:200',
            'cakupan_wilayah' => [
                'required',
                ValidationRule::in(['Luar Institusi', 'Institusi', 'Jurusan', 'Program Studi']),
            ],
            'deskripsi' => 'required|string|max:255',
            'progres' => 'nullable|numeric',
            'keterangan' => 'nullable|string|max:255',
            'deadline' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'status' => [
                'required',
                ValidationRule::in(['Belum Proses', 'Proses', 'Selesai']),
            ],
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

        // Menyimpan data kegiatan ke dalam database
        KegiatanModel::create([
            'user_id' => $request->user_id,
            'tahun_id' => $request->tahun_id,
            'kategori_kegiatan_id' => $request->kategori_kegiatan_id,
            'beban_kegiatan_id' => $request->beban_kegiatan_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'cakupan_wilayah' => $request->cakupan_wilayah,
            'deskripsi' => $request->deskripsi,
            'progres' => $request->progres,
            'keterangan' => $request->keterangan,
            'deadline' => $request->deadline,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
            'surat_tugas' => $suratTugasPath
        ]);

        // Mengembalikan response sukses
        return response()->json([
            'status' => true,
            'message' => 'Data Kegiatan berhasil disimpan'
        ]);
    }
    return redirect('/kegiatannonjti');
}


    public function edit_ajax(string $id)
    {   switch(auth()->user()->level->level_kode){
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
        $user = UserModel::select('user_id', 'nama')->get();
        $kategori = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori')
        ->whereIn('kategori_kegiatan_id', [3])
        ->get();
        
        $beban = BebanKegiatanModel::select('beban_kegiatan_id', 'nama_beban')->get();
        
        $kegiatannonjti = KegiatanModel::find($id);

        return view($redirect.'.kegiatannonjti.edit_ajax', [
            'kegiatannonjti' => $kegiatannonjti,
            'user' => $user,
            'kategori' => $kategori,
            'beban' => $beban
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|integer',
                'kategori_kegiatan_id' => 'required|integer',
                'beban_kegiatan_id' => 'required|integer',
                'nama_kegiatan' => 'required|string',
                'cakupan_wilayah' => [
                    'required', ValidationRule::in(['Luar Institusi','Institusi','Jurusan','Program Studi']),
                ],
                'waktu_mulai' => 'nullable|date',
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

            $check = KegiatanModel::find($id);
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
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $kegiatannonjti = KegiatanModel::find($id);
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
        return view($redirect.'.kegiatannonjti.confirm_ajax', ['kegiatannonjti' => $kegiatannonjti]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kegiatannonjti = KegiatanModel::find($id);

            if ($kegiatannonjti) {
                $kegiatannonjti->delete();
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
        }
        return redirect('/kegiatannonjti');
    }

    public function showSuratTugas($id)
    {
        // Cari data kegiatan berdasarkan ID
        $kegiatannonjti = KegiatanModel::select('surat_tugas')->find($id);

        // Periksa apakah data ditemukan
        if (!$kegiatannonjti || !$kegiatannonjti->surat_tugas) {
            return response()->json([
                'status' => 'error',
                'message' => 'Surat tugas tidak ditemukan.',
            ], 404);
        }

        // Path surat tugas
        $pathSuratTugas = asset($kegiatannonjti->surat_tugas);

        // Tampilkan path surat tugas
        return response()->json([
            'status' => 'success',
            'surat_tugas' => $pathSuratTugas,
        ]);
    }
}
