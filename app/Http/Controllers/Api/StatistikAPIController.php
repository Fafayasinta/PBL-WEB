<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatistikBebanKerja; // Pastikan Anda memiliki model ini
use Illuminate\Http\Request;

class StatistikAPIController extends Controller
{
    /**
     * Menampilkan data statistik beban kerja dosen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil data statistik beban kerja dosen
        $statistik = StatistikBebanKerja::all();  // Atau sesuaikan dengan kebutuhan query

        // Mengembalikan data statistik dalam format JSON
        return response()->json([
            'status' => true,
            'data' => $statistik,
        ], 200);
    }

    /**
     * Menampilkan detail statistik beban kerja dosen berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mencari data statistik berdasarkan ID
        $statistik = StatistikBebanKerja::find($id);

        if ($statistik) {
            return response()->json([
                'status' => true,
                'data' => $statistik,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }
}
