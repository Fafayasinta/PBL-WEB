<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BobotJabatanModel;
use App\Models\KegiatanDosenModel;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;
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

    if ($request->jabatan) {
        $jabatankegiatan->where('jabatan', $request->jabatan);
    }

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

}
