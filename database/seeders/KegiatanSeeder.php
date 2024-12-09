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
                'tahun_id' => 3,
                'pic' => 'Dika Rizky Yunianto, S.Kom, M.Kom',
                'cakupan_wilayah' => 'Luar Institusi',
                'deskripsi' => 'JTI Play Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya',
                'waktu_mulai' => '2024-10-01',
                'waktu_selesai' => '2024-11-03',
                'deadline' => '2024-11-10',
                'status' => 'Proses',
                'progres' => 0.8,
                'keterangan' => 'Kurang Penyusunan LPJ',
                'icon' => 'kegiatan/jtiplayit.png',
            ],
            [
                'nama_kegiatan' => 'Dialog Dosen Mahasiswa 2024',
                'kategori_kegiatan_id' => 1,
                'user_id' => 57,
                'beban_kegiatan_id' => 2,
                'tahun_id' => 3,
                'pic' => 'Faiz Ushbah Mubarok, S.Pd., M.Pd.',
                'cakupan_wilayah' => 'Jurusan',
                'deskripsi' => 'DDM Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya',
                'waktu_mulai' => '2024-04-01',
                'waktu_selesai' => '2024-05-15',
                'deadline' => '2024-05-20',
                'status' => 'Selesai',
                'progres' => 1.0,
                'keterangan' => 'LPJ Telah diserahkan',
                'icon' => 'kegiatan/dialog.png',
            ],
            [
                'nama_kegiatan' => 'Coaching Clinic 2024',
                'kategori_kegiatan_id' => 1,
                'user_id' => 7,
                'beban_kegiatan_id' => 3,
                'tahun_id' => 3,
                'pic' => 'Atiqah Nurul Asri, S.Pd., M.Pd.',
                'deskripsi' => '',
                'cakupan_wilayah' => 'Jurusan',
                'waktu_mulai' => '2024-02-01',
                'waktu_selesai' => '2024-03-05',
                'deadline' => '2024-03-17',
                'status' => 'Selesai',
                'progres' => 1.0,
                'keterangan' => 'LPJ Telah diserahkan',
                'icon' => 'kegiatan/coaching.png',
            ],
            [
                'nama_kegiatan' => 'Magang Prodi D4 Teknik Informatika',
                'kategori_kegiatan_id' => 2, // Sesuaikan ID kategori
                'user_id' => 42, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'tahun_id' => 3,
                'pic' => 'Dika Rizky Yunianto, S.Kom, M.Kom',
                'cakupan_wilayah' => 'Program Studi',
                'deskripsi' => 'Magang TI Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya',
                'waktu_mulai' => '2024-11-10',
                'waktu_selesai' => '2025-01-25',
                'deadline' => '2025-01-30',
                'status' => 'Proses',
                'progres' => 0.4,
                'keterangan' => 'Tahap Penjaringan Mahasiswa',
                'icon' => 'kegiatan/magangti.png',
            ],
            [
                'nama_kegiatan' => 'Magang Prodi D4 Sistem Informasi Bisnis',
                'kategori_kegiatan_id' => 2, // Sesuaikan ID kategori
                'user_id' => 53, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'tahun_id' => 3,
                'pic' => 'Vivin Ayu Lestari, S.Pd, M.Kom',
                'cakupan_wilayah' => 'Program Studi',
                'deskripsi' => 'Magang SIB Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya',
                'waktu_mulai' => '2024-11-10',
                'waktu_selesai' => '2025-01-25',
                'deadline' => '2025-01-30',
                'status' => 'Proses',
                'progres' => 0.4,
                'keterangan' => 'Tahap Penjaringan Mahasiswa',
                'icon' => 'kegiatan/magangsib.png',
            ],
            [
                'nama_kegiatan' => 'Intercomp 2024',
                'kategori_kegiatan_id' => 1,
                'user_id' => 46,
                'beban_kegiatan_id' => 3,
                'tahun_id' => 3,
                'pic' => 'Muhammad Afif Hendrawan, S.Kom., M.T.',
                'cakupan_wilayah' => 'Jurusan',
                'deskripsi' => '',
                'waktu_mulai' => '2024-03-01',
                'waktu_selesai' => '2024-04-25',
                'deadline' => '2024-04-29',
                'status' => 'Selesai',
                'progres' => 1.0,
                'keterangan' => 'LPJ Telah Diserahkan',
                'icon' => 'kegiatan/intercomp.png',
            ],
            [
                'nama_kegiatan' => 'Programmer di Puskom Polinema',
                'kategori_kegiatan_id' => 3, // Sesuaikan ID kategori
                'user_id' => 63, // Sesuaikan ID user
                'beban_kegiatan_id' => 1,
                'tahun_id' => 3,
                'pic' => 'Moch Zawaruddin Abdullah, S.ST., M.Kom.',
                'cakupan_wilayah' => 'Institusi',
                'deskripsi' => '',
                'waktu_mulai' => '2024-01-01',
                'waktu_selesai' => '2026-01-01',
                'deadline' => '2026-01-01',
                'status' => 'Proses',
                'progres' => 0.2,
                'keterangan' => 'Menjadi Programmer di Puskom Polinema Pusat',
                'icon' => 'kegiatan/programmer.png',
            ],
            [
                'nama_kegiatan' => 'Upskilling Training dengan tema Communication Skill',
                'kategori_kegiatan_id' => 3,
                'user_id' => 8,
                'beban_kegiatan_id' => 2,
                'tahun_id' => 3,
                'pic' => 'Banni Satria Andoko, S. Kom., M.MSI',
                'cakupan_wilayah' => 'Luar Institusi',
                'deskripsi' => '',
                'waktu_mulai' => '2024-10-18',
                'waktu_selesai' => '2024-10-18',
                'deadline' => '2024-10-18',
                'status' => 'Selesai',
                'progres' => 1.0,
                'keterangan' => 'Mengikuti training di luar polinema',
                'icon' => 'kegiatan/upskill.png',
            ],
        ]);
    }
}