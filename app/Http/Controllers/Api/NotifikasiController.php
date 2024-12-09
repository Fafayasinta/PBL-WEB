<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotifikasiModel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $datas = NotifikasiModel::where('user_id', auth()->user()->user_id)->get();
            return $this->successResponse($datas, 'Data notifikasi');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}
