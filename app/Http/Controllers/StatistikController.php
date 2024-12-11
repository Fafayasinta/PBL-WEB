<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use App\Models\TahunModel;
use App\Models\AnggotaKegiatanModel;
use App\Models\BobotJabatanModel;
use App\Models\KategoriKegiatanModel;
use Yajra\DataTables\DataTables;

class StatistikController extends Controller
{
    public function index()
    {
        $activeMenu = 'statistik';
        $breadcrumb = (object) [
            'title' => 'Statistik Beban Kerja Dosen',
            'list' => ['Home', 'statistik']
        ];
        switch(auth()->user()->level->level_kode){
            case('ADMIN'):
                $redirect =  'admin';
                break;
            case('PIMPINAN'):
                $redirect =  'pimpinan';
                break;        
        }
        return view($redirect.'.statistik.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    public function list(Request $request){
        
        $kegiatanjti = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'user_id', 'deskripsi', 'kategori_kegiatan_id', 'status', 'beban_kegiatan_id','tahun_id')
            ->with('kategori')
            ->with('beban')
            ->with('tahun')
            ->with('user')
            ->whereIn('kategori_kegiatan_id', [1, 2]);
            $kegiatan = KegiatanModel::find($request->kegiatan_id);
            $dosen = AnggotaKegiatanModel::where('kegiatan_id', $request->kegiatan_id)->get();


    //  if ($request->nama_kategori) {
    //         $kegiatanjti->whereHas('kategori_kegiatan', function ($query) use ($request) {
    //             $query->where('nama_kategori', $request->nama_kategori);
    //      });
    //  }

    //  if ($request->status) {
    //      $kegiatanjti->where('status', $request->status);
    //  }

    $tahun = TahunModel::all();


        return DataTables::of($kegiatanjti)
        ->addIndexColumn()
        ->addColumn('action', function ($kegiatanjti) {

            
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }
}
