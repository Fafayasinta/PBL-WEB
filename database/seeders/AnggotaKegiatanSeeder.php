<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaKegiatanSeeder extends Seeder
{
    public function run()
    {
        $anggota = [
            // Anggota untuk JTI Play IT (kegiatan_id = 1)
            [
                'kegiatan_id' => 1,
                'user_id' => 42, // ID Dika Rizky
                'jabatan' => 'PIC',
                'beban_kerja' => 5.0
            ],
            [
                'kegiatan_id' => 1, 
                'user_id' => 48, // ID Vivi
                'jabatan' => 'Sekretaris',
                'beban_kerja' => 4.0
            ],
            
            // Anggota untuk Dialog Dosen Mahasiswa (kegiatan_id = 2)
            [
                'kegiatan_id' => 2,
                'user_id' => 53, // ID Faiz
                'jabatan' => 'PIC',
                'beban_kerja' => 3.0
            ],
            [
                'kegiatan_id' => 2,
                'user_id' => 10, // ID Meyti 
                'jabatan' => 'Anggota',
                'beban_kerja' => 2.0
            ]
        ];

        DB::table('t_anggota_kegiatan')->insert($anggota);
    }
}