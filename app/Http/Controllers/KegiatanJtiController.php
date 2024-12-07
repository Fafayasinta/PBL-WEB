<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

        return view('admin.kegiatanjti.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'status' => $status
        ]);
    }

    public function list(Request $request)
    {
        $kegiatanjti = KegiatanModel::select('kegiatan_id', 'nama_kegiatan', 'deskripsi', 'kategori_kegiatan_id', 'status', 'beban_kegiatan_id')
            ->with('kategori')
            ->with('beban')
            ->whereIn('kategori_kegiatan_id', [1, 2]);

    //  if ($request->nama_kategori) {
    //         $kegiatanjti->whereHas('kategori_kegiatan', function ($query) use ($request) {
    //             $query->where('nama_kategori', $request->nama_kategori);
    //      });
    //  }

    //  if ($request->status) {
    //      $kegiatanjti->where('status', $request->status);
    //  }

        return DataTables::of($kegiatanjti)
        ->addIndexColumn()
        ->addColumn('action', function ($kegiatanjti) {
            $btn  = '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kegiatanjti/' . $kegiatanjti->kegiatan_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true); // Pastikan metode make(true) dipanggil
    }

    public function edit_ajax(string $id)
    {
        $kegiatanjti = KegiatanModel::find($id);

        return view('admin.kegiatanjti.edit_ajax', ['kegiatanjti' => $kegiatanjti]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kegiatan' => 'required|string|max:200',
                'deskripsi' => 'required|string|max:255',
                'nama_kategori' => 'required|string|max:100|unique:m_kategori_kegiatan,kategori_kegiatan_id,' . $id . ',kategori_kegiatan_id',
                'status' => [
                    'required',
                    ValidationRule::in(['Belum Proses','Proses','Selesai']),
                ],
                'nama_beban' => 'required|string|max:100|unique:m_beban_kegiatan,beban_kegiatan_id,' . $id . ',beban_kegiatan_id',
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
    {
        $kegiatanjti = KegiatanModel::find($id);

        return view('admin.kegiatanjti.confirm_ajax', ['kegiatanjti' => $kegiatanjti]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kegiatanjti = KegiatanModel::find($id);

            if ($kegiatanjti) {
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
            return redirect('/kegiatanjti');
        }
    }
    public function show_ajax($id)
{
    // Ambil data dari tabel t_kegiatan
    $kegiatan = DB::table('t_kegiatan')->where('id', $id)->first();

    // Ambil data anggota dari t_anggota_kegiatan
    $anggotaKegiatan = DB::table('t_anggota_kegiatan')
        ->where('kegiatan_id', $id)
        ->join('users', 't_anggota_kegiatan.user_id', '=', 'users.id') // Join dengan tabel users jika perlu nama anggota
        ->select('users.name as nama_anggota', 't_anggota_kegiatan.posisi', 't_anggota_kegiatan.bobot')
        ->get();

    // Ambil data agenda dari t_kegiatan_agenda
    $agendaKegiatan = DB::table('t_kegiatan_agenda')
        ->where('kegiatan_id', $id)
        ->select('id', 'nama_agenda', 'waktu', 'tempat', 'keterangan', 'penanggung_jawab', 'progress')
        ->get();

    return view('pimpinan.detail_kegiatan', compact('kegiatan', 'anggotaKegiatan', 'agendaKegiatan'));
}

}
