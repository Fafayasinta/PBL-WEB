<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaKegiatanSeeder extends Seeder
{
    public function run()
    {

        // Data kegiatan dan jabatan, disesuaikan dengan cakupan wilayah dan jabatan
        $data = [
            // Anggota untuk kegiatan 'JTI Play IT!' (Kegiatan ID = 1, Cakupan: Luar Institusi)
            ['user_id' => 42, 'kegiatan_id' => 1, 'jabatan' => 'PIC', 'skor' => 5.00], // Dika Rizky Yunianto
            ['user_id' => 75, 'kegiatan_id' => 1, 'jabatan' => 'Sekretaris', 'skor' => 4.00],
            ['user_id' => 63, 'kegiatan_id' => 1, 'jabatan' => 'Bendahara', 'skor' => 4.00],
            ['user_id' => 21, 'kegiatan_id' => 1, 'jabatan' => 'Anggota', 'skor' => 3.00],

            // Anggota untuk kegiatan 'Dialog Dosen Mahasiswa 2024' (Kegiatan ID = 2, Cakupan: Jurusan)
            ['user_id' => 57, 'kegiatan_id' => 2, 'jabatan' => 'PIC', 'skor' => 3.00], // Faiz Ushbah Mubarok
            ['user_id' => 45, 'kegiatan_id' => 2, 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 18, 'kegiatan_id' => 2, 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 34, 'kegiatan_id' => 2, 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Anggota untuk kegiatan 'Coaching Clinic 2024' (Kegiatan ID = 3, Cakupan: Jurusan)
            ['user_id' => 7, 'kegiatan_id' => 3, 'jabatan' => 'PIC', 'skor' => 3.00], // Atiqah Nurul Asri
            ['user_id' => 14, 'kegiatan_id' => 3, 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 25, 'kegiatan_id' => 3, 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 50, 'kegiatan_id' => 3, 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Anggota untuk kegiatan 'Magang Prodi D4 Teknik Informatika' (Kegiatan ID = 4, Cakupan: Program Studi)
            ['user_id' => 42, 'kegiatan_id' => 4, 'jabatan' => 'PIC', 'skor' => 3.00], // Dika Rizky Yunianto
            ['user_id' => 8, 'kegiatan_id' => 4, 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 12, 'kegiatan_id' => 4, 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 30, 'kegiatan_id' => 4, 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Anggota untuk kegiatan 'Magang Prodi D4 Sistem Informasi Bisnis' (Kegiatan ID = 5, Cakupan: Program Studi)
            ['user_id' => 53, 'kegiatan_id' => 5, 'jabatan' => 'PIC', 'skor' => 3.00], // Vivin Ayu Lestari
            ['user_id' => 15, 'kegiatan_id' => 5, 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 29, 'kegiatan_id' => 5, 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 40, 'kegiatan_id' => 5, 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Anggota untuk kegiatan 'Intercomp 2024' (Kegiatan ID = 6, Cakupan: Jurusan)
            ['user_id' => 46, 'kegiatan_id' => 6, 'jabatan' => 'PIC', 'skor' => 3.00], // Muhammad Afif Hendrawan
            ['user_id' => 19, 'kegiatan_id' => 6, 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['user_id' => 36, 'kegiatan_id' => 6, 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['user_id' => 27, 'kegiatan_id' => 6, 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Anggota untuk kegiatan 'Programmer di Puskom Polinema' (Kegiatan ID = 7, Cakupan: Institusi)
            ['user_id' => 63, 'kegiatan_id' => 7, 'jabatan' => 'PIC', 'skor' => 4.00], // Moch Zawaruddin Abdullah
            

            // Anggota untuk kegiatan 'Upskilling Training dengan tema Communication Skill' (Kegiatan ID = 8, Cakupan: Luar Institusi)
            ['user_id' => 8, 'kegiatan_id' => 8, 'jabatan' => 'PIC', 'skor' => 5.00], // Banni Satria Andoko
            
        ];

        // Insert data ke database
        DB::table('t_anggota_kegiatan')->insert($data);
    }
}