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

class KegiatanNonJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatannonjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan Non JTI',
            'list' => ['Home', 'kegiatannonjti']
        ];
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
        ]);
    }

    public function list(Request $request)
    {
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

        return DataTables::of($kegiatannonjti)
        ->addIndexColumn()
        ->addColumn('action', function ($kegiatannonjti) {
            $btn  = '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatannonjti/' . $kegiatannonjti->kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
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
    {
        $kategori = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori')
        ->whereIn('kategori_kegiatan_id', [3])
        ->get();

        $beban = BebanKegiatanModel::select('beban_kegiatan_id', 'nama_beban')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $tahun = TahunModel::select('tahun_id', 'tahun')->get();

        return view('admin.kegiatannonjti.create_ajax')->with([
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

        return redirect('/kegiatannonjti');
    }

    public function edit_ajax(string $id)
    {
        $kegiatannonjti = KegiatanModel::find($id);
        $user = UserModel::select('user_id', 'nama')->get();
        $beban = BebanKegiatanModel::select('beban_kegiatan_id', 'nama_beban')->get();
        $kategori = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori')
        ->whereIn('kategori_kegiatan_id', [3])
        ->get();

        return view('admin.kegiatannonjti.edit_ajax', [
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
                'user_id' => 'required|numeric',
                'kategori_kegiatan_id' => 'required|numeric',
                'beban_kegiatan_id' => 'required|numeric',
                'nama_kegiatan' => 'required|string|max:200',
                'cakupan_wilayah' => [
                    'required',
                    ValidationRule::in(['Luar Institusi','Institusi','Jurusan','Program Studi']),
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
        return redirect('/kegiatannonjti');
    }

    public function confirm_ajax(string $id)
    {
        $kegiatannonjti = KegiatanModel::find($id);

        return view('admin.kegiatannonjti.confirm_ajax', ['kegiatannonjti' => $kegiatannonjti]);
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
            return redirect('/kegiatannonjti');
        }
    }
}
