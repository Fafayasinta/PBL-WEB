<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_kegiatan')->insert([
            [
                'nama_kegiatan' => 'JTI Play IT!',
                'kategori_kegiatan_id' => 1, // Sesuaikan ID kategori
                'user_id' => 42, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'pic' => 'Dika Rizky Yunianto, S.Kom, M.Kom',
                'cakupan_wilayah' => 'Luar Institusi',
                'waktu_mulai' => '2024-10-01 00:00:00',
                'waktu_selesai' => '2024-11-03 00:00:00',
                'deadline' => '2024-11-10 00:00:00',
                'status' => 'Proses',
                'progres' => 0.8,
                'deskripsi' => 'Kurang Penyusunan LPJ',
            ],
            [
                'nama_kegiatan' => 'Dialog Dosen Mahasiswa 2024',
                'kategori_kegiatan_id' => 1,
                'user_id' => 57,
                'beban_kegiatan_id' => 2,
                'pic' => 'Faiz Ushbah Mubarok, S.Pd., M.Pd.',
                'cakupan_wilayah' => 'Jurusan',
                'waktu_mulai' => '2024-04-01 00:00:00',
                'waktu_selesai' => '2024-05-15 00:00:00',
                'deadline' => '2024-05-20 00:00:00',
                'status' => 'Selesai',
                'progres' => 1.0,
                'deskripsi' => 'LPJ Telah diserahkan',
            ],
            [
                'nama_kegiatan' => 'Coaching Clinic 2024',
                'kategori_kegiatan_id' => 1,
                'user_id' => 7,
                'beban_kegiatan_id' => 3,
                'pic' => 'Atiqah Nurul Asri, S.Pd., M.Pd.',
                'cakupan_wilayah' => 'Jurusan',
                'waktu_mulai' => '2024-02-01 00:00:00',
                'waktu_selesai' => '2024-03-05 00:00:00',
                'deadline' => '2024-03-17 00:00:00',
                'status' => 'Selesai',
                'progres' => 1.0,
                'deskripsi' => 'LPJ Telah diserahkan',
            ],
            [
                'nama_kegiatan' => 'Magang Prodi D4 Teknik Informatika',
                'kategori_kegiatan_id' => 2, // Sesuaikan ID kategori
                'user_id' => 42, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'pic' => 'Dika Rizky Yunianto, S.Kom, M.Kom',
                'cakupan_wilayah' => 'Program Studi',
                'waktu_mulai' => '2024-11-10 00:00:00',
                'waktu_selesai' => '2025-01-25 00:00:00',
                'deadline' => '2025-01-30 00:00:00',
                'status' => 'Proses',
                'progres' => 0.4,
                'deskripsi' => 'Tahap Penjaringan Mahasiswa',
            ],
            [
                'nama_kegiatan' => 'Magang Prodi D4 Sistem Informasi Bisnis',
                'kategori_kegiatan_id' => 2, // Sesuaikan ID kategori
                'user_id' => 53, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'pic' => 'Vivin Ayu Lestari, S.Pd, M.Kom',
                'cakupan_wilayah' => 'Program Studi',
                'waktu_mulai' => '2024-11-10 00:00:00',
                'waktu_selesai' => '2025-01-25 00:00:00',
                'deadline' => '2025-01-30 00:00:00',
                'status' => 'Proses',
                'progres' => 0.4,
                'deskripsi' => 'Tahap Penjaringan Mahasiswa',
            ],
            [
                'nama_kegiatan' => 'Intercomp 2024',
                'kategori_kegiatan_id' => 1,
                'user_id' => 46,
                'beban_kegiatan_id' => 3,
                'pic' => 'Muhammad Afif Hendrawan, S.Kom., M.T.',
                'cakupan_wilayah' => 'Jurusan',
                'waktu_mulai' => '2024-03-01 00:00:00',
                'waktu_selesai' => '2024-04-25 00:00:00',
                'deadline' => '2024-04-29 00:00:00',
                'status' => 'Selesai',
                'progres' => 1.0,
                'deskripsi' => 'LPJ Telah Diserahkan',
            ],
            [
                'nama_kegiatan' => 'Programmer di Puskom Polinema',
                'kategori_kegiatan_id' => 3, // Sesuaikan ID kategori
                'user_id' => 63, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'pic' => 'Moch Zawaruddin Abdullah, S.ST., M.Kom.',
                'cakupan_wilayah' => 'Institusi',
                'waktu_mulai' => '2024-01-01 00:00:00',
                'waktu_selesai' => '2026-01-01 00:00:00',
                'deadline' => '2026-01-01 00:00:00',
                'status' => 'Proses',
                'progres' => 0.2,
                'deskripsi' => 'Menjadi Programmer di Puskom Polinema Pusat',
            ],
            [
                'nama_kegiatan' => 'Upskilling Training dengan tema Communication Skill',
                'kategori_kegiatan_id' => 3,
                'user_id' => 8,
                'beban_kegiatan_id' => 2,
                'pic' => 'Banni Satria Andoko, S. Kom., M.MSI',
                'cakupan_wilayah' => 'Luar Institusi',
                'waktu_mulai' => '2024-10-18 00:00:00',
                'waktu_selesai' => '2024-10-18 00:00:00',
                'deadline' => '2024-10-18 00:00:00',
                'status' => 'Selesai',
                'progres' => 1.0,
                'deskripsi' => 'Mengikuti training di luar polinema',
            ],
        ]);
    }
}