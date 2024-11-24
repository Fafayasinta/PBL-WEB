<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanAgendaSeeder extends Seeder
{
    public function run()
    {
        // Data agenda untuk masing-masing kegiatan
        $agendas = [
            // Agenda untuk JTI Play IT (kegiatan_id = 1)
            [
                'kegiatan_id' => 1,
                'waktu' => '2024-10-05 09:00:00', 
                'tempat' => 'Auditorium JTI',
                'progres' => 0.00,
                'keterangan' => 'Rapat Persiapan Awal',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kegiatan_id' => 1,
                'waktu' => '2024-10-15 13:00:00',
                'tempat' => 'Lab Programming',
                'progres' => 0.00,
                'keterangan' => 'Technical Meeting',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            
            // Agenda untuk Dialog Dosen Mahasiswa (kegiatan_id = 2) 
            [
                'kegiatan_id' => 2,
                'waktu' => '2024-04-10 10:00:00',
                'tempat' => 'Ruang Rapat JTI', 
                'progres' => 0.00,
                'keterangan' => 'Koordinasi Panitia',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('t_kegiatan_agenda')->insert($agendas);
    }
}