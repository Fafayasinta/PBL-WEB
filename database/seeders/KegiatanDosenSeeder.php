<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KegiatanDosenSeeder extends Seeder
{
    public function run()
    {
        // Data kegiatan dosen dengan jabatan, skor, dan deadline sesuai dengan data di tabel t_kegiatan
        $data = [
            // Kegiatan untuk 'JTI Play IT!' (Kegiatan ID = 1, deadline diambil dari t_kegiatan)
            ['user_id' => 42, 'kegiatan_id' => 1, 'deadline' => Carbon::parse('2024-12-05 12:00:00'), 'jabatan' => 'PIC', 'skor' => 5.00],
            ['user_id' => 75, 'kegiatan_id' => 1, 'deadline' => Carbon::parse('2024-12-05 12:00:00'), 'jabatan' => 'Sekretaris', 'skor' => 4.00],
            ['user_id' => 63, 'kegiatan_id' => 1, 'deadline' => Carbon::parse('2024-12-05 12:00:00'), 'jabatan' => 'Bendahara', 'skor' => 4.00],
            ['user_id' => 21, 'kegiatan_id' => 1, 'deadline' => Carbon::parse('2024-12-05 12:00:00'), 'jabatan' => 'Anggota', 'skor' => 3.00],

            // Kegiatan untuk 'Dialog Dosen Mahasiswa 2024' (Kegiatan ID = 2, deadline diambil dari t_kegiatan)
            ['user_id' => 57, 'kegiatan_id' => 2, 'deadline' => Carbon::parse('2024-11-20 15:00:00'), 'jabatan' => 'PIC', 'skor' => 3.00],
            ['user_id' => 45, 'kegiatan_id' => 2, 'deadline' => Carbon::parse('2024-11-20 15:00:00'), 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 18, 'kegiatan_id' => 2, 'deadline' => Carbon::parse('2024-11-20 15:00:00'), 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 34, 'kegiatan_id' => 2, 'deadline' => Carbon::parse('2024-11-20 15:00:00'), 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Kegiatan untuk 'Coaching Clinic 2024' (Kegiatan ID = 3, deadline diambil dari t_kegiatan)
            ['user_id' => 7, 'kegiatan_id' => 3, 'deadline' => Carbon::parse('2024-12-10 16:00:00'), 'jabatan' => 'PIC', 'skor' => 3.00],
            ['user_id' => 14, 'kegiatan_id' => 3, 'deadline' => Carbon::parse('2024-12-10 16:00:00'), 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 25, 'kegiatan_id' => 3, 'deadline' => Carbon::parse('2024-12-10 16:00:00'), 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 50, 'kegiatan_id' => 3, 'deadline' => Carbon::parse('2024-12-10 16:00:00'), 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Kegiatan untuk 'Magang Prodi D4 Teknik Informatika' (Kegiatan ID = 4, deadline diambil dari t_kegiatan)
            ['user_id' => 42, 'kegiatan_id' => 4, 'deadline' => Carbon::parse('2024-12-15 14:00:00'), 'jabatan' => 'PIC', 'skor' => 3.00],
            ['user_id' => 8, 'kegiatan_id' => 4, 'deadline' => Carbon::parse('2024-12-15 14:00:00'), 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 12, 'kegiatan_id' => 4, 'deadline' => Carbon::parse('2024-12-15 14:00:00'), 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 30, 'kegiatan_id' => 4, 'deadline' => Carbon::parse('2024-12-15 14:00:00'), 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Kegiatan untuk 'Magang Prodi D4 Sistem Informasi Bisnis' (Kegiatan ID = 5, deadline diambil dari t_kegiatan)
            ['user_id' => 53, 'kegiatan_id' => 5, 'deadline' => Carbon::parse('2024-12-20 11:00:00'), 'jabatan' => 'PIC', 'skor' => 3.00],
            ['user_id' => 15, 'kegiatan_id' => 5, 'deadline' => Carbon::parse('2024-12-20 11:00:00'), 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 29, 'kegiatan_id' => 5, 'deadline' => Carbon::parse('2024-12-20 11:00:00'), 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 40, 'kegiatan_id' => 5, 'deadline' => Carbon::parse('2024-12-20 11:00:00'), 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Kegiatan untuk 'Intercomp 2024' (Kegiatan ID = 6, deadline diambil dari t_kegiatan)
            ['user_id' => 46, 'kegiatan_id' => 6, 'deadline' => Carbon::parse('2024-12-25 17:00:00'), 'jabatan' => 'PIC', 'skor' => 3.00],
            ['user_id' => 19, 'kegiatan_id' => 6, 'deadline' => Carbon::parse('2024-12-25 17:00:00'), 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 36, 'kegiatan_id' => 6, 'deadline' => Carbon::parse('2024-12-25 17:00:00'), 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 27, 'kegiatan_id' => 6, 'deadline' => Carbon::parse('2024-12-25 17:00:00'), 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Kegiatan untuk 'Programmer di Puskom Polinema' (Kegiatan ID = 7, deadline diambil dari t_kegiatan)
            ['user_id' => 63, 'kegiatan_id' => 7, 'deadline' => Carbon::parse('2024-12-30 13:00:00'), 'jabatan' => 'PIC', 'skor' => 4.00],

            // Kegiatan untuk 'Upskilling Training dengan tema Communication Skill' (Kegiatan ID = 8, deadline diambil dari t_kegiatan)
            ['user_id' => 8, 'kegiatan_id' => 8, 'deadline' => Carbon::parse('2024-11-30 10:00:00'), 'jabatan' => 'PIC', 'skor' => 5.00],
        ];

        // Insert data ke database
        DB::table('t_kegiatan_dosen')->insert($data);
    }
}
