<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaKegiatanSeeder extends Seeder
{
    public function run()
    {
        $anggota = [
            [
                'kegiatan_id' => 1,
                'user_id' => 42, 
                'jabatan' => 'PIC',
                'beban_kerja' => 5.0
            ],
            [
                'kegiatan_id' => 1, 
                'user_id' => 48, 
                'jabatan' => 'Sekretaris',
                'beban_kerja' => 4.0
            ],
            
            [
                'kegiatan_id' => 2,
                'user_id' => 53, 
                'jabatan' => 'PIC',
                'beban_kerja' => 3.0
            ],
            [
                'kegiatan_id' => 2,
                'user_id' => 10, 
                'jabatan' => 'Anggota',
                'beban_kerja' => 2.0
            ]
        ];

        DB::table('t_anggota_kegiatan')->insert($anggota);
    }
}