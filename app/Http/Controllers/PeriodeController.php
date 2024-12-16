<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use App\Models\TahunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

use App\Models\NotifikasiModel;
class PeriodeController extends Controller
{
    public function index()
    {
        $activeMenu = 'periode';
        $breadcrumb = (object) [
            'title' => 'Data Periode',
            'list' => ['Home', 'Periode']
        ];
        $user = auth()->user()->user_id;
        $notifikasi = NotifikasiModel::with('user')->where('user_id',$user)->latest('created_at')->get();
    
        $periode = TahunModel::all();

        return view('admin.periode.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'notifikasi'=> $notifikasi,
            'periode' => $periode
        ]);
    }

    public function list(Request $request)
    {
    $periode = TahunModel::select('tahun_id','tahun');

    return DataTables::of($periode)
        ->addIndexColumn()
        ->addColumn('action', function ($periode) {
            $btn  = '<button onclick="modalAction(\'' . url('/periode/' . $periode->tahun_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/periode/' . $periode->tahun_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/periode/' . $periode->tahun_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 5px; font-size: 14px; font-weight: bold; padding: 5px 10px;margin: 1px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })
        ->rawColumns(['action']) // Pastikan kolom 'password' mendukung HTML
        ->make(true);
    }

    public function show_ajax(string $id){
        $periode = KegiatanModel::where('tahun_id', $id)->get();

        // Kirim data tahun dan kegiatan ke view
        return view('admin.periode.show_ajax', ['periode' => $periode,]);
    }

    public function create_ajax()
    {
        $periode = TahunModel::select('tahun_id', 'tahun')->get();

        return view('admin.periode.create_ajax')->with('periode', $periode);
    }

    public function store_ajax(Request $request)
    {

        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'tahun' => 'required|string|unique:m_tahun,tahun_id'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            TahunModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data Jenis Kegiatan berhasil disimpan'
            ]);
        }
        return redirect('/periode');
    }

    public function edit_ajax(string $id)
    {
        $periode = TahunModel::find($id);

        return view('admin.periode.edit_ajax', ['periode' => $periode]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'tahun' => 'required|string|unique:m_tahun,tahun_id,' . $id . ',tahun_id',
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

            $check = TahunModel::find($id);
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
        return redirect('/periode');
    }

    public function confirm_ajax(string $id)
    {
        $periode = TahunModel::find($id);

        return view('admin.periode.confirm_ajax', ['periode' => $periode]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $periode = TahunModel::find($id);

            if ($periode) {
                $periode->delete();
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
            return redirect('/periode');
        }
    }
}