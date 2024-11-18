<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        $levels = LevelModel::all();
        return response()->json([
            'status' => 'success',
            'data' => $levels
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_kode' => 'required|string|max:50|unique:m_level',
            'level_nama' => 'required|string|max:100',
            'level_deskripsi' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $level = LevelModel::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $level
        ], 201);
    }

    public function show(LevelModel $level)
    {
        return response()->json([
            'status' => 'success',
            'data' => $level
        ]);
    }

    public function update(Request $request, LevelModel $level)
    {
        $validator = Validator::make($request->all(), [
            'level_kode' => 'required|string|max:50|unique:m_level,level_kode,' . $level->level_id . ',level_id',
            'level_nama' => 'required|string|max:100',
            'level_deskripsi' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $level->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $level
        ]);
    }

    public function destroy(LevelModel $level)
    {
        $level->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Level deleted successfully'
        ]);
    }
}