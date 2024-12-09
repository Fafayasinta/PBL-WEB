<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        try {
            $limit = $request->query('limit');
            $search = $request->query('search');
            $kategori = $request->query('kategori');
            $status = $request->query('status');

            $datas = KegiatanModel::with([
                'anggota' => function ($query) {
                    $query->orderBy('skor', 'desc');
                }
            ])->with('user', 'kategori', 'beban', 'tahun', 'agenda', 'agenda.user')
                ->when($search, function ($query) use ($search) {
                    return $query->where('nama_kegiatan', 'like', '%' . $search . '%');
                })
                ->when($limit, function ($query) use ($limit) {
                    return $query->limit($limit);
                })
                ->when($kategori, function ($query) use ($kategori) {
                    return $query->where('kategori_kegiatan_id', $kategori);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->get();

            return $this->successResponse($datas, 'Data kegiatan');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function userKegiatan()
    {
        try {
            $datas = KegiatanModel::where('user_id', auth()->user()->user_id)->get();
            return $this->successResponse($datas, 'Data kegiatan user');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function countKegiatan()
    {
        try {
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function countByStatus(Request $request)
    {
        try {
            $isStatistic = $request->query('isStatistic');
            $totalCount = KegiatanModel::count();

            // Daftar status yang ingin selalu ditampilkan
            $allStatuses = ['Belum Proses', 'Proses', 'Selesai', 'Ditunda'];

            $counts = KegiatanModel::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get()
                ->keyBy('status')
                ->toArray();

            $result = [];

            foreach ($allStatuses as $status) {
                $statusData = isset($counts[$status]) ? $counts[$status] : ['status' => $status, 'total' => 0];

                if ($isStatistic) {
                    $statusData['percentage'] = $totalCount > 0 ? round(($statusData['total'] / $totalCount) * 100, 2) : 0;
                }

                $result[] = $statusData;
            }

            return $this->successResponse($result, 'Jumlah kegiatan berdasarkan status');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}
