<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BobotJabatanModel;
use Illuminate\Support\Facades\Validator;
use App\Models\KegiatanDosenModel;
use App\Models\KegiatanModel;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Yajra\DataTables\DataTables;

class JabatanKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'jabatankegiatan';
        $breadcrumb = (object) [
            'title' => 'Data Jabatan Kegiatan',
            'list' => ['Home', 'jabatankegiatan']
        ];

        $jabatankegiatan = BobotJabatanModel::all();

        return view('admin.jabatankegiatan.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'jabatankegiatan' => $jabatankegiatan,
        ]);
    }

    public function list(Request $request)
{
    $jabatankegiatan = BobotJabatanModel::select('bobot_jabatan_id', 'cakupan_wilayah', 'jabatan', 'skor');

    // if ($request->jabatan) {
    //     $jabatankegiatan->where('jabatan', $request->jabatan);
    // }

    return DataTables::of($jabatankegiatan)
        ->addIndexColumn()
        ->addColumn('action', function ($jabatankegiatan) {
            $btn  = '<button onclick="modalAction(\'' . url('/jabatankegiatan/' . $jabatankegiatan->bobot_jabatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jabatankegiatan/' . $jabatankegiatan->bobot_jabatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/jabatankegiatan/' . $jabatankegiatan->bobot_jabatan_id . '/delete_ajax') . '\')"  
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
        $jabatankegiatan = BobotJabatanModel::find($id);
        return view('admin.jabatankegiatan.show_ajax', ['jabatankegiatan' => $jabatankegiatan]);
    }

    public function edit_ajax(string $id)
    {
        $jabatankegiatan = BobotJabatanModel::find($id);

        return view('admin.jabatankegiatan.edit_ajax', ['jabatankegiatan' => $jabatankegiatan]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'cakupan_wilayah' => [
                    'required',
                    ValidationRule::in(['Luar Institusi', 'Institusi', 'Jurusan', 'Program Studi']), // Validasi nilai enum
                ],
                'jabatan' => [
                    'required',
                    ValidationRule::in(['PIC', 'Sekretaris', 'Bendahara', 'Anggota']), // Validasi nilai enum
                ],
                'skor' => 'required|numeric|between:0,9999.99', // Validasi skor sebagai angka desimal
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

            $check = BobotJabatanModel::find($id);
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
        return redirect('/jabatankegiatan ');
    }

    public function confirm_ajax(string $id)
    {
        $jabatankegiatan = BobotJabatanModel::find($id);

        return view('admin.jabatankegiatan.confirm_ajax', ['jabatankegiatan' => $jabatankegiatan]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $jabatankegiatan = BobotJabatanModel::find($id);

            if ($jabatankegiatan) {
                $jabatankegiatan->delete();
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
            return redirect('/jabatankegiatan');
        }
    }
}
