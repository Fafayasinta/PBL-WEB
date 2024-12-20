<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKegiatanModel;
use App\Models\BebanKegiatanModel;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanAgendaModel;
use App\Models\KegiatanModel;
use App\Models\SuratTugasModel;

use App\Models\TahunModel;
use App\Models\UserModel;
use App\Notifications\kegiatan;
use App\Notifications\KegiatanNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth; // Pastikan Auth diimpor

use App\Models\NotifikasiModel;
class KegiatanJtiController extends Controller
{ 
    public function index()
    {
        $activeMenu = 'kegiatanjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan JTI',
            'list' => ['Home', 'Kegiatan JTI']
        ];

        $status = KegiatanModel::all();
        $tahun = TahunModel::all();
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
        return view($redirect.'.kegiatanjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'status' => $status,
            'notifikasi'=> $notifikasi,
            'tahun' => $tahun
        ]);
    }


public function list(Request $request)
{
    $loggedInUser = Auth::user(); // Ambil pengguna yang login
    $kegiatanjti = KegiatanModel::select(
            'kegiatan_id',
            'nama_kegiatan',
            'user_id',
            'deskripsi',
            'kategori_kegiatan_id',
            'status',
            'beban_kegiatan_id',
            'tahun_id'
        )
        ->with('kategori')
        ->with('beban')
        ->with('tahun')
        ->with('user')
        ->with('anggota')
        ->whereIn('kategori_kegiatan_id', [1, 2]); // Filter kategori default

    // Cek level pengguna login
    if ($loggedInUser->level->level_kode == 'DOSEN') {
        // Jika level pengguna adalah DOSEN, filter kegiatan berdasarkan user_id
        $kegiatanjti->whereHas('user', function ($query) use ($loggedInUser) {
            $query->where('user_id', $loggedInUser->user_id);
        });
    }
    // Jika pengguna adalah admin atau pimpinan, tampilkan semua data kegiatan tanpa filter tambahan
    
    $tahun = TahunModel::all(); // Ambil data tahun untuk filter dropdown di front-end


    return DataTables::of($kegiatanjti)
        ->addIndexColumn()
        ->addColumn('action', function ($kegiatanjti) {
            
            $btn = '<a href="' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/show') . '" 
                    class="btn btn-info btn-sm" 
                    style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                    Detail
                </a>';
            
            $pic = AnggotaKegiatanModel::where('user_id',auth()->user()->user_id)->first();
            if($pic?->jabatan == 'PIC' || auth()->user()->level->level_kode == 'ADMIN' ){
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            };
            if(auth()->user()->level->level_kode == 'ADMIN'){
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            }
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}

    public function show_ajax(string $id)
    {
        $kegiatanjti = AnggotaKegiatanModel::with('user') // Memuat relasi user
            ->where('kegiatan_id', $id) // Filter berdasarkan kegiatan_id
            ->get();
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
        return view($redirect.'.kegiatanjti.show_ajax', ['kegiatanjti' => $kegiatanjti]);
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
        ->whereIn('kategori_kegiatan_id', [1, 2])
        ->get();

        $beban = BebanKegiatanModel::select('beban_kegiatan_id', 'nama_beban')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $tahun = TahunModel::select('tahun_id', 'tahun')->get();

        return view($redirect.'.kegiatanjti.create_ajax')->with([
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
                ]
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                KegiatanModel::create($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data Kegiatan JTI berhasil disimpan'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data',
                    'error' => $e->getMessage()
                ]);
            }
        }

        return redirect('/kegiatanjti');
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
        $kategori = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori')
        ->whereIn('kategori_kegiatan_id', [1, 2])
        ->get();
        $beban = BebanKegiatanModel::select('beban_kegiatan_id', 'nama_beban')->get();
        $kegiatanjti = KegiatanModel::find($id);

        return view($redirect.'.kegiatanjti.edit_ajax', [
            'kategori' => $kategori,
            'beban' => $beban,
            'kegiatanjti' => $kegiatanjti
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kegiatan' => 'required|string|max:200',
                'deskripsi' => 'required|string|max:255',
                'kategori_kegiatan_id' => 'required|integer|exists:m_kategori_kegiatan,kategori_kegiatan_id',
                'status' => 'required|in:Belum Proses,Proses,Selesai',
                'beban_kegiatan_id' => 'required|integer|exists:m_beban_kegiatan,beban_kegiatan_id'
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
        return redirect('/kegiatanjti');
    }

    public function confirm_ajax(string $id)
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
        $kegiatanjti = KegiatanModel::find($id);

        return view($redirect.'.kegiatanjti.confirm_ajax', ['kegiatanjti' => $kegiatanjti]);
    }

    public function delete_ajax(Request $request, string $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        $kegiatanjti = KegiatanModel::find($id);

        if ($kegiatanjti) {
            // Hapus semua data terkait di tabel anggota
            $kegiatanjti->anggota()->delete();

            // Jika ada tabel relasi lain yang terkait, tambahkan di sini
            $kegiatanjti->agenda()->delete();

            // Hapus data di tabel kegiatan
            $kegiatanjti->delete();

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

    return redirect('/kegiatanjti');
}




    //DETAIL KEGIATAN JTI
    public function show($id)
    { 
        //Cek siapa yg login
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
    
        // Ambil data kegiatan berdasarkan ID yang diberikan
        $kegiatanjti = KegiatanModel::find($id);
        $pic = AnggotaKegiatanModel::where('user_id',auth()->user()->user_id)->first();
        // Menyiapkan breadcrumb dan halaman untuk tampilan
        $breadcrumb = (object) [
            'title' => 'Detail ' . $kegiatanjti->nama_kegiatan,
            'list' => ['Home', 'Kegiatan JTI', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail ' . $kegiatanjti->nama_kegiatan,
        ];

        $activeMenu = 'kegiatanjti';

        // Panggil fungsi listDetail untuk mendapatkan data anggota kegiatan berdasarkan kegiatan_id
        $anggotakegiatanjti = $this->listAnggota(request(), $id);
        $agendakegiatanjti = $this->listAgenda(request(), $id);

        // Kembalikan view dengan data yang telah difilter
        return view($redirect.'.kegiatanjti.show', [
            'breadcrumb' => $breadcrumb, 
            
            'page' => $page, 
            'pic' => $pic,
            'kegiatanjti' => $kegiatanjti, 
            'activeMenu' => $activeMenu,
            'notifikasi'=> $notifikasi,
            'anggotakegiatanjti' => $anggotakegiatanjti, // Kirimkan data detail kegiatan
            'agendakegiatanjti' => $agendakegiatanjti // Kirimkan data detail kegiatan
        ]);
    }

    public function listAnggota(Request $request, $id)
    {
        // Mengambil data anggota kegiatan berdasarkan kegiatan_id yang dipilih
        $anggotakegiatanjti = AnggotaKegiatanModel::select('anggota_id', 'user_id', 'kegiatan_id', 'jabatan', 'skor')
            ->with('user')
            ->with('kegiatan')
            ->whereIn('kegiatan_id', [$id]); // Filter berdasarkan kegiatan_id

        return DataTables::of($anggotakegiatanjti)
            ->addIndexColumn()
            ->addColumn('action', function ($anggotakegiatanjti) {
                // Menambahkan tombol aksi untuk setiap data anggota kegiatan
                $btn  = '<button onclick="modalAction(\'' . url('/anggota/' . $anggotakegiatanjti->anggota_id . '/show_ajax') . '\')" 
                            class="btn btn-info btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                            Detail
                        </button> ';
                if(auth()->user()->level->level_kode == 'ADMIN'){
                $btn .= '<button onclick="modalAction(\'' . url('/anggota/' . $anggotakegiatanjti->anggota_id . '/edit_ajax') . '\')" 
                            class="btn btn-warning btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                            Edit
                        </button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/anggota/' . $anggotakegiatanjti->anggota_id . '/delete_ajax') . '\')"  
                            class="btn btn-danger btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                            Hapus
                        </button> ';
                }
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }

    public function listAgenda(Request $request, $id)
    {   
        // Mengambil data anggota kegiatan berdasarkan kegiatan_id yang dipilih
        $agendakegiatanjti = KegiatanAgendaModel::select('agenda_id', 'user_id', 'kegiatan_id', 'nama_agenda', 'deadline', 'lokasi', 'progres', 'keterangan')
            ->with('user')
            ->with('kegiatan')
            ->whereIn('kegiatan_id', [$id]); // Filter berdasarkan kegiatan_id
            $loggedInUser = Auth::user();
            
        return DataTables::of($agendakegiatanjti)
            ->addIndexColumn()
            ->addColumn('action', function ($agendakegiatanjti) {
                $pic = AnggotaKegiatanModel::where('user_id',auth()->user()->user_id)->first();
            
                // Menambahkan tombol aksi untuk setiap data anggota kegiatan
                
                $btn  = '<button onclick="modalAction(\'' . url('/agenda/' . $agendakegiatanjti->agenda_id . '/show_ajax') . '\')" 
                            class="btn btn-info btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                            Detail
                        </button> ';
                if($pic?->jabatan == 'PIC' || auth()->user()->level->level_kode == 'ADMIN'){
                $btn .= '<button onclick="modalAction(\'' . url('/agenda/' . $agendakegiatanjti->agenda_id . '/edit_ajax') . '\')" 
                            class="btn btn-warning btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                            Edit
                        </button> ';
                
                $btn .= '<button onclick="modalAction(\'' . url('/agenda/' . $agendakegiatanjti->agenda_id . '/delete_ajax') . '\')"  
                            class="btn btn-danger btn-sm" 
                            style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                            Hapus
                        </button> ';
                }
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }


    public function create_ajaxAnggota($id)
    {   //Cek siapa yg login
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
        $anggota = AnggotaKegiatanModel::select('anggota_id', 'user_id', 'kegiatan_id', 'jabatan', 'skor')
        ->where('kegiatan_id', $id)
        ->get();

        $user = UserModel::select('user_id', 'nama')->get();

        return view($redirect.'.kegiatanjti.anggota_create_ajax', compact('kegiatanjti'))->with([
            'anggota' => $anggota,
            'user' => $user
        ]);
    }

    public function store_ajaxAnggota(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|integer|exists:m_user,user_id',
                'jabatan' => [
                    'required',
                    ValidationRule::in(['PIC', 'Sekretaris', 'Bendahara', 'Anggota']),
                ],
                'skor' => 'nullable|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                $data = $request->all();
                $data['kegiatan_id'] = $id;

                AnggotaKegiatanModel::create($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Data Kegiatan JTI berhasil disimpan'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data',
                    'error' => $e->getMessage()
                ]);
            }
        }   

        return redirect('/kegiatanjti/' . $id . '/show');
    }
}

// public function list(Request $request)
    // {
    //     $kegiatanjti = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'user_id', 'deskripsi', 'kategori_kegiatan_id', 'status', 'beban_kegiatan_id','tahun_id')
    //         ->with('kategori')
    //         ->with('beban')
    //         ->with('tahun')
    //         ->with('user')
    //         ->whereIn('kategori_kegiatan_id', [1, 2]);
            
    //     $tahun = TahunModel::all();


    //     return DataTables::of($kegiatanjti)
    //     ->addIndexColumn()
    //     ->addColumn('action', function ($kegiatanjti) {


    //         $btn = '<a href="' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/show') . '" 
    //                 class="btn btn-info btn-sm" 
    //                 style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
    //                 Detail
    //             </a>';

    //         $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/edit_ajax') . '\')" 
    //                     class="btn btn-warning btn-sm" 
    //                     style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
    //                     Edit
    //                 </button> ';
    //         $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/delete_ajax') . '\')"  
    //                     class="btn btn-danger btn-sm" 
    //                     style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
    //                     Hapus
    //                 </button> ';
    //         return $btn;
    //     })
    //     ->rawColumns(['action'])
    //     ->make(true); // Pastikan metode make(true) dipanggil
    // }

   