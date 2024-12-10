<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TahunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodeAPIController extends Controller
{
    /**
     * Get a list of all periods (tahun).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $periode = TahunModel::all();

        return response()->json([
            'status' => true,
            'data' => $periode
        ]);
    }

    /**
     * Store a new period (tahun).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'tahun' => 'required|string|unique:m_tahun,tahun_id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ]);
        }

        $periode = TahunModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Periode berhasil ditambahkan',
            'data' => $periode
        ]);
    }

    /**
     * Show the details of a specific period (tahun).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $periode = TahunModel::find($id);

        if (!$periode) {
            return response()->json([
                'status' => false,
                'message' => 'Periode tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $periode
        ]);
    }

    /**
     * Update a specific period (tahun).
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'tahun' => 'required|string|unique:m_tahun,tahun_id,' . $id . ',tahun_id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ]);
        }

        $periode = TahunModel::find($id);

        if (!$periode) {
            return response()->json([
                'status' => false,
                'message' => 'Periode tidak ditemukan'
            ], 404);
        }

        $periode->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Periode berhasil diperbarui',
            'data' => $periode
        ]);
    }

    /**
     * Delete a specific period (tahun).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $periode = TahunModel::find($id);

        if (!$periode) {
            return response()->json([
                'status' => false,
                'message' => 'Periode tidak ditemukan'
            ], 404);
        }

        $periode->delete();

        return response()->json([
            'status' => true,
            'message' => 'Periode berhasil dihapus'
        ]);
    }
}
