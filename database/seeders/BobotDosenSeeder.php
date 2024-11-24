<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BobotDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menyusun data untuk t_bobot_dosen
        DB::table('t_bobot_dosen')->insert([
            [
                'user_id' => 42, 
                'beban_kegiatan_id' => 1, 
                'kegiatan_id' => 1, 
                'skor' => 5.00, 
                'waktu_mulai' => '2024-10-01 00:00:00',
                'waktu_selesai' => '2024-11-03 00:00:00',
            ],
            [
                'user_id' => 57, 
                'beban_kegiatan_id' => 2, 
                'kegiatan_id' => 2, 
                'skor' => 3.00, 
                'waktu_mulai' => '2024-04-01 00:00:00',
                'waktu_selesai' => '2024-05-15 00:00:00',
            ],
            [
                'user_id' => 7, 
                'beban_kegiatan_id' => 3, 
                'kegiatan_id' => 3, 
                'skor' => 3.00, 
                'waktu_mulai' => '2024-02-01 00:00:00',
                'waktu_selesai' => '2024-03-05 00:00:00',
            ],
            [
                'user_id' => 42, 
                'beban_kegiatan_id' => 1, 
                'kegiatan_id' => 4, 
                'skor' => 3.00, 
                'waktu_mulai' => '2024-11-10 00:00:00',
                'waktu_selesai' => '2025-01-25 00:00:00',
            ],
            [
                'user_id' => 53,
                'beban_kegiatan_id' => 1, 
                'kegiatan_id' => 5, 
                'skor' => 3.00, 
                'waktu_mulai' => '2024-11-10 00:00:00',
                'waktu_selesai' => '2025-01-25 00:00:00',
            ],
            [
                'user_id' => 46,
                'beban_kegiatan_id' => 3, 
                'kegiatan_id' => 6, 
                'skor' => 3.00, 
                'waktu_mulai' => '2024-03-01 00:00:00',
                'waktu_selesai' => '2024-04-25 00:00:00',
            ],
            [
                'user_id' => 63,
                'beban_kegiatan_id' => 2, 
                'kegiatan_id' => 7, 
                'skor' => 4.00, 
                'waktu_mulai' => '2024-01-01 00:00:00',
                'waktu_selesai' => '2026-01-01 00:00:00',
            ],
            [
                'user_id' => 8,
                'beban_kegiatan_id' => 2, 
                'kegiatan_id' => 8, 
                'skor' => 5.00, 
                'waktu_mulai' => '2024-10-18 00:00:00',
                'waktu_selesai' => '2024-10-18 00:00:00',
            ],
        ]);
    }
}