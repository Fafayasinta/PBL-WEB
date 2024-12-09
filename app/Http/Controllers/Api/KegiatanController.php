<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        try {
            $datas = KegiatanModel::all();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function userKegiatan(){
        try {
            $datas = KegiatanModel::where('user_id', auth()->user()->user_id)->get();
            return $this->successResponse($datas, 'Data kegiatan user');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}
