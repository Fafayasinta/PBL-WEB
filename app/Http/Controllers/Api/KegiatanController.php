<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanModel;
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

    public function userKegiatan(Request $request)
    {
        $status = $request->query('status');
        try {
            $datas = KegiatanModel::where('user_id', auth()->user()->user_id)->with('user', 'kategori', 'beban', 'tahun', 'agenda', 'agenda.user')
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })->get();
            return $this->successResponse($datas, 'Data kegiatan user');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $data = KegiatanModel::with(
                'user',
                'kategori',
                'beban',
                'tahun',
                'agenda',
                'agenda.user',
                'anggota',
                'anggota.user'
            )->find($id);
            return $this->successResponse($data, 'Data kegiatan');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
    public function countByStatus(Request $request)
    {
        try {
            $isStatistic = $request->query('isStatistic');
            $totalCount = KegiatanModel::count();

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

    public function countByCategory(Request $request)
    {
        try {
            $month = $request->query('month');
            $year = $request->query('year');

            $query = KegiatanModel::query();

            if ($month) {
                $query->whereMonth('waktu_mulai', '=', $this->convertMonthToNumber($month));
            }
            if ($year) {
                $query->whereYear('waktu_mulai', '=', $year);
            }

            $totalKegiatan = $query->count();

            $categories = $query->select(
                'kategori_kegiatan_id',
                DB::raw('COUNT(*) as total')
            )
                ->with('kategori')
                ->groupBy('kategori_kegiatan_id')
                ->get();

            $categories->each(function ($category) use ($totalKegiatan) {
                $category->name = $category->kategori->nama_kategori ?? null;
                $category->percentage = $totalKegiatan > 0
                    ? round(($category->total / $totalKegiatan) * 100, 2)
                    : 0;
                unset($category->kategori);
            });

            return $this->successResponse($categories, 'Data jumlah kegiatan berdasarkan kategori');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function countByUser(Request $request)
    {
        try {
            $month = $request->query('month');
            $year = $request->query('year');

            $query = KegiatanModel::query();

            if ($month) {
                $query->whereMonth('waktu_mulai', '=', $this->convertMonthToNumber($month));
            }
            if ($year) {
                $query->whereYear('waktu_mulai', '=', $year);
            }

            $topUsers = $query->select(
                'user_id',
                DB::raw('COUNT(*) as total'),
                DB::raw('MONTH(waktu_mulai) as month_number')
            )
                ->groupBy('user_id', 'month_number')
                ->orderByDesc('total')
                ->limit(5)
                ->get();

            $bulanIndonesia = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            $topUsers->each(function ($kegiatan) use ($bulanIndonesia) {
                $kegiatan->month = $bulanIndonesia[$kegiatan->month_number] ?? null;
                $kegiatan->user_name = $kegiatan->user->username
                    ? ucwords(strtolower($kegiatan->user->username))
                    : null;
                unset($kegiatan->user);
            });

            return $this->successResponse($topUsers, 'Top 5 user dengan kegiatan terbanyak');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    private function convertMonthToNumber($month)
    {
        $months = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12
        ];

        return $months[$month] ?? null;
    }
}
