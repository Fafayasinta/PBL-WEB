<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'jeniskegiatan';
        $breadcrumb = (object) [
            'title' => 'Kelola Jenis Kegiatan',
            'list' => ['Home', 'Jenis Kegiatan']
        ];
        
        $jeniskegiatan = KegiatanModel::all();

        return view('admin.jeniskegiatan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'jeniskegiatan' => $jeniskegiatan
        ]);
    }

    public function list(Request $request)
    {
        $jeniskegiatan = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori');

        // if ($request->nama_kategori) {
        //     $jeniskegiatan->where('nama_kategori', $request->nama_kategori);
        // }

        return DataTables::of($jeniskegiatan)
        ->addIndexColumn()
        ->addColumn('action', function ($jeniskegiatan) {
            $btn  = '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kategori_kegiatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kategori_kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jeniskegiatan/' . $jeniskegiatan->kategori_kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })             
        ->rawColumns(['action'])
        ->make(true);
    }

    public function show_ajax(string $id){

        $jeniskegiatan = KategoriKegiatanModel::find($id);

        return view('admin.jeniskegiatan.show_ajax', ['jeniskegiatan' => $jeniskegiatan]);
    }

    public function edit_ajax(string $id)
    {
        $jeniskegiatan = KategoriKegiatanModel::find($id);

        return view('admin.jeniskegiatan.edit_ajax', ['jeniskegiatan' => $jeniskegiatan]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,kategori_kegiatan_id,' . $id . ',kategori_kegiatan_id',
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

            $check = KategoriKegiatanModel::find($id);
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
        return redirect('/jeniskegiatan ');
    }

    public function create_ajax()
    {
        $jeniskegiatan = KategoriKegiatanModel::select('kategori_kegiatan_id', 'nama_kategori', 'deskripsi')->get();

        return view('admin.jeniskegiatan.create_ajax')->with('jeniskegiatan', $jeniskegiatan);
    }

    public function store_ajax(Request $request)
    {

        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,kategori_kegiatan_id',
                'deskripsi' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            KategoriKegiatanModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data Jenis Kegiatan berhasil disimpan'
            ]);
        }
        return redirect('/jeniskegiatan');
    }

    public function confirm_ajax(string $id)
    {
        $jeniskegiatan = KategoriKegiatanModel::find($id);

        return view('admin.jeniskegiatan.confirm_ajax', ['jeniskegiatan' => $jeniskegiatan]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jeniskegiatan = KategoriKegiatanModel::find($id);

            if ($jeniskegiatan) {
                $jeniskegiatan->delete();
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
            return redirect('/jeniskegiatan');
        }
    }
}
