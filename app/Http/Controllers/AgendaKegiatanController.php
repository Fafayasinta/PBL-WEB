<?php

namespace App\Http\Controllers;

use App\Models\KegiatanAgendaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AgendaKegiatanController extends Controller
{
    public function index()
    {
        $activeMenu = 'agenda';
        $breadcrumb = (object) [
            'title' => 'Data Agenda Kegiatan',
            'list' => ['Home', 'Agenda']
        ];

        $agenda = KegiatanAgendaModel::all();
        $agendaUnique = $agenda->unique('kegiatan_id');

        return view('admin.agenda.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'agenda' => $agenda,
            'agendaUnique' => $agendaUnique
        ]);
    }

    public function list(Request $request)
    {
    $agenda = KegiatanAgendaModel::select('agenda_id', 'kegiatan_id', 'user_id', 'nama_agenda', 'deadline', 'lokasi', 'progres', 'keterangan')
    ;

    if ($request->jabatan) {
        $agenda->where('jabatan', $request->jabatan);
    }

    return DataTables::of($agenda)
        ->addIndexColumn()
        ->addColumn('action', function ($agenda) {
            $btn  = '<button onclick="modalAction(\'' . url('/agenda/' . $agenda->bobot_jabatan_id . '/show_ajax') . '\')" 
                        class="btn btn-info btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(40, 167, 69, 0.5); color: green; border: rgba(40, 167, 69, 0.8);">
                        Detail
                     </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/agenda/' . $agenda->bobot_jabatan_id . '/edit_ajax') . '\')" 
                        class="btn btn-warning btn-sm" 
                        style="border-radius: 10px; font-size: 16px; font-weight: bold; padding: 5px 30px; background-color: rgba(255, 193, 7, 0.5); color: orange; border: rgba(255, 193, 7, 0.8);">
                        Edit
                    </button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/agenda/' . $agenda->bobot_jabatan_id . '/delete_ajax') . '\')"  
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
