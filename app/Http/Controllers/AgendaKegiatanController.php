<?php

namespace App\Http\Controllers;

use App\Models\KegiatanAgendaModel;
use Illuminate\Http\Request;

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
            'agenda' => $agendaUnique
        ]);
    }
}
