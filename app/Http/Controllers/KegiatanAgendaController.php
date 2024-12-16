<?php

namespace App\Http\Controllers;

use App\Models\KegiatanAgendaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\NotifikasiModel;
class KegiatanAgendaController extends Controller
{
    /**
     * Menampilkan daftar agenda kegiatan
     */
    public function index()
    {   $user = auth()->user()->user_id;
        $notifikasi = NotifikasiModel::with('user')->where('user_id',$user)->latest('created_at')->get();
    
        $agendas = KegiatanAgendaModel::with('kegiatan')->get();
        return response()->json([
            'success' => true,
            'data' => $agendas
        ]);
    }

    /**
     * Menyimpan agenda kegiatan baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'required|exists:t_kegiatan,kegiatan_id',
            'deadline' => 'required|date',
            'lokasi' => 'required|string',
            'progres' => 'required|numeric|between:0,100',
            'keterangan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $agenda = KegiatanAgendaModel::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Agenda kegiatan berhasil ditambahkan',
            'data' => $agenda
        ], 201);
    }

    /**
     * Menampilkan detail agenda kegiatan
     */
    public function show($id)
    {
        $agenda = KegiatanAgendaModel::with('kegiatan')->find($id);
        
        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda kegiatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $agenda
        ]);
    }

    /**
     * Mengupdate agenda kegiatan
     */
    public function update(Request $request, $id)
    {
        $agenda = KegiatanAgendaModel::find($id);

        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda kegiatan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'exists:t_kegiatan,kegiatan_id',
            'deadline' => 'date',
            'lokasi' => 'string',
            'progres' => 'numeric|between:0,100',
            'keterangan' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $agenda->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Agenda kegiatan berhasil diupdate',
            'data' => $agenda
        ]);
    }

    /**
     * Menghapus agenda kegiatan
     */
    public function destroy($id)
    {
        $agenda = KegiatanAgendaModel::find($id);

        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda kegiatan tidak ditemukan'
            ], 404);
        }

        $agenda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agenda kegiatan berhasil dihapus'
        ]);
    }
}