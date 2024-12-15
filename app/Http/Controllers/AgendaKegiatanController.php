<?php

namespace App\Http\Controllers;

use App\Models\KegiatanAgendaModel;
use App\Models\KegiatanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class AgendaKegiatanController extends Controller
{
    public function index()
    {
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
        $activeMenu = 'agenda';
        $breadcrumb = (object) [
            'title' => 'Data Agenda Kegiatan',
            'list' => ['Home', 'Agenda']
        ];

        $agenda = KegiatanAgendaModel::all();
        $agendaUnique = $agenda->unique('kegiatan_id');

        return view($redirect.'.agenda.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'agenda' => $agenda,
            'agendaUnique' => $agendaUnique
        ]);
    }

    public function list(Request $request)
    {
    $agenda = KegiatanAgendaModel::select('agenda_id', 'kegiatan_id', 'user_id', 'nama_agenda', 'deadline', 'lokasi', 'progres', 'keterangan')
    ->with('kegiatan')
    ->with('user');

    if ($request->kegiatan_id) {
        $agenda->where('kegiatan_id', $request->kegiatan_id);
    }

    return DataTables::of($agenda)
        ->addIndexColumn()
        ->addColumn('action', function ($agenda) {
            $btn  = '<button onclick="modalAction(\'' . url('/agenda/' . $agenda->agenda_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 5px; font-size: 12px; font-weight: bold; padding: 5px 10px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/agenda/' . $agenda->agenda_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 5px; font-size: 12px; font-weight: bold; padding: 5px 10px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/agenda/' . $agenda->agenda_id . '/delete_ajax') . '\')"  
                        class="btn btn-danger btn-sm" 
                        style="border-radius: 5px; font-size: 12px; font-weight: bold; padding: 5px 10px; background-color: rgba(220, 53, 69, 0.5); color: red; border: rgba(220, 53, 69, 0.8);">
                        Hapus
                    </button> ';
            return $btn;
        })          
        ->rawColumns(['action'])
        ->make(true);
    }

    public function create_ajax()
    {   
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
        $kegiatan = KegiatanModel::select('kegiatan_id', 'nama_kegiatan')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        
        return view($redirect.'.agenda.create_ajax')->with([
            'user' => $user,
            'kegiatan' => $kegiatan
        ]);
    }

    public function store_ajax(Request $request)
    {

        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kegiatan_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'nama_agenda' => 'required',
                'deadline' => 'required|date',
                'lokasi' => 'required|string',
                'progres' => 'required|numeric|between:0,9999.99', // Validasi skor sebagai angka desimal
                'keterangan' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            KegiatanAgendaModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data Jenis Kegiatan berhasil disimpan'
            ]);
        }
        return redirect('/kegiatanjti');
    }

    public function show_ajax(string $id){
        $agenda = KegiatanAgendaModel::find($id);
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

        return view($redirect.'.agenda.show_ajax', ['agenda' => $agenda]);
    }

    public function edit_ajax(string $id)
    {
        $kegiatan = KegiatanModel::select('kegiatan_id', 'nama_kegiatan')->get();
        $user = UserModel::select('user_id', 'nama')->get();
        $agenda = KegiatanAgendaModel::find($id);

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
        return view($redirect.'.agenda.edit_ajax', [
            'agenda' => $agenda,
            'kegiatan' => $kegiatan,
            'user' => $user
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kegiatan_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'nama_agenda' => 'required',
                'deadline' => 'required|date',
                'lokasi' => 'required|string',
                'progres' => 'required|numeric|between:0,9999.99', // Validasi skor sebagai angka desimal
                'keterangan' => 'required|string'
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

            $check = KegiatanAgendaModel::find($id);
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
        return redirect(url('/kegiatanjti/' . $id->kegiatan_id . '/show'));
    }

    public function confirm_ajax(string $id)
    {
        $agenda = KegiatanAgendaModel::find($id);

        return view('admin.agenda.confirm_ajax', ['agenda' => $agenda]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $agenda = KegiatanAgendaModel::find($id);

            if ($agenda) {
                $agenda->delete();
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
            return redirect(url('/kegiatanjti/' . $id->kegiatan_id . '/show'));
        }
    }
}
