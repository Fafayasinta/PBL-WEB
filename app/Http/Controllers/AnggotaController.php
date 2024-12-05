<?php
namespace App\Http\Controllers;

use App\Models\AnggotaKegiatanModel;
use App\Models\UserModel;
use App\Models\KegiatanModel;
use Illuminate\Http\Request;

class AnggotaController extends Controller 
{
    public function tambahAnggota(Request $request, $kegiatan_id)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:m_user,user_id',
                'jabatan' => 'required|in:PIC,Sekretaris,Bendahara,Anggota',
                'bobot' => 'required|numeric|min:0|max:100'
            ]);

            // Cek apakah user sudah menjadi anggota
            $exists = AnggotaKegiatanModel::where('kegiatan_id', $kegiatan_id)
                ->where('user_id', $request->user_id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dosen sudah menjadi anggota kegiatan ini'
                ], 422);
            }

            // Cek jumlah PIC
            if ($request->jabatan === 'PIC') {
                $picCount = AnggotaKegiatanModel::where('kegiatan_id', $kegiatan_id)
                    ->where('jabatan', 'PIC')
                    ->count();

                if ($picCount >= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Kegiatan sudah memiliki PIC'
                    ], 422);
                }
            }

            // Set bobot berdasarkan jabatan dan wilayah
            $kegiatan = KegiatanModel::find($kegiatan_id);
            $bobot = $this->hitungBobot($request->jabatan, $kegiatan->cakupan_wilayah);

            $anggota = AnggotaKegiatanModel::create([
                'user_id' => $request->user_id,
                'kegiatan_id' => $kegiatan_id,
                'jabatan' => $request->jabatan,
                'skor' => $bobot
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil ditambahkan',
                'data' => $anggota
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function hitungBobot($jabatan, $wilayah)
    {
        $bobot = [
            'Luar Institusi' => [
                'PIC' => 5.00,
                'Sekretaris' => 4.00,
                'Bendahara' => 4.00,
                'Anggota' => 3.00
            ],
            'Institusi' => [
                'PIC' => 4.00,
                'Sekretaris' => 3.50,
                'Bendahara' => 3.50,
                'Anggota' => 3.00
            ],
            'Jurusan' => [
                'PIC' => 3.00,
                'Sekretaris' => 2.50,
                'Bendahara' => 2.50,
                'Anggota' => 2.00
            ],
            'Program Studi' => [
                'PIC' => 3.00,
                'Sekretaris' => 2.50,
                'Bendahara' => 2.50,
                'Anggota' => 2.00
            ]
        ];

        return $bobot[$wilayah][$jabatan];
    }

    public function hapusAnggota($kegiatan_id, $anggota_id)
    {
        try {
            $anggota = AnggotaKegiatanModel::where('kegiatan_id', $kegiatan_id)
                ->where('anggota_id', $anggota_id)
                ->firstOrFail();

            $anggota->delete();

            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}