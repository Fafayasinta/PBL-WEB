<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKegiatanModel;
use App\Models\BebanKegiatanModel;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanAgendaModel;
use App\Models\KegiatanModel;
use App\Models\TahunModel;
use App\Models\UserModel;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class KegiatanJtiController extends Controller
{
    public function index()
    {
        $activeMenu = 'kegiatanjti';
        $breadcrumb = (object) [
            'title' => 'Data Kegiatan JTI',
            'list' => ['Home', 'kegiatanjti']
        ];

        $status = KegiatanModel::all();

        return view('admin.kegiatanjti.index', compact('activeMenu', 'breadcrumb', 'status'));
    }

    public function list(Request $request)
    {
        $kegiatanjti = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'user_id', 'deskripsi', 'kategori_kegiatan_id', 'status', 'beban_kegiatan_id')
            ->with(['kategori', 'beban', 'user']) // Pastikan relasi ada di model
            ->whereIn('kategori_kegiatan_id', [1, 2]);

        return DataTables::of($kegiatanjti)
            ->addIndexColumn()
            ->addColumn('action', function ($kegiatanjti) {
                $btn = '<a href="' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/show') . '" 
                        class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/edit_ajax') . '\')" 
                         class="btn btn-warning btn-sm">Edit</button>';
                $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/delete_ajax') . '\')"  
                         class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store_ajax(Request $request)
    {
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
            'deadline' => 'required|date|after_or_equal:today',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'status' => ['required', ValidationRule::in(['Belum Proses', 'Proses', 'Selesai'])],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            KegiatanModel::create($request->all());
            return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan', 'error' => $e->getMessage()]);
        }
    }

    public function delete_ajax(Request $request, string $id)
    {
        $kegiatanjti = KegiatanModel::find($id);

        if (!$kegiatanjti) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        try {
            $kegiatanjti->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data', 'error' => $e->getMessage()]);
        }
    }

    // Pastikan fungsi lain seperti edit_ajax, confirm_ajax, dll. juga diperbaiki sesuai dengan pola yang sama
}
