<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanAgendaSeeder extends Seeder
{
    public function run()
    {
        // Data agenda untuk kegiatan yang ada
        $data = [
            // Kegiatan 'JTI Play IT!' (Kegiatan ID = 1)

            ['kegiatan_id' => 1, 'user_id' => 17, 'nama_agenda' => 'Rapat Persiapan', 'deadline' => '2024-12-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 1.00, 'keterangan' => 'Rapat persiapan awal untuk kegiatan JTI Play IT!', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 1, 'user_id' => 62, 'nama_agenda' => 'Rapat Koordinasi', 'deadline' => '2024-12-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 1.00, 'keterangan' => 'Rapat koordinasi dengan panitia utama', 'icon' => 'kegiatan/icon2.png'],
            ['kegiatan_id' => 1, 'user_id' => 51, 'nama_agenda' => 'Rapat Evaluasi', 'deadline' => '2024-12-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 1.00, 'keterangan' => 'Rapat evaluasi tahapan kegiatan', 'icon' => 'kegiatan/icon3.png'],
            ['kegiatan_id' => 1, 'user_id' => 41, 'nama_agenda' => 'Hari Pelaksanaan', 'deadline' => '2024-12-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 1.00, 'keterangan' => 'Briefing dan simulasi kegiatan secara langsung', 'icon' => 'kegiatan/icon4.png'],

            // Kegiatan 'Dialog Dosen Mahasiswa 2024' (Kegiatan ID = 2)
            ['kegiatan_id' => 2, 'user_id' => 37, 'nama_agenda' => 'Rapat Persiapan', 'deadline' => '2024-11-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 1.00, 'keterangan' => 'Rapat persiapan awal untuk kegiatan Dialog Dosen Mahasiswa', 'icon' => 'kegiatan/icon3.png'],
            ['kegiatan_id' => 2, 'user_id' => 24, 'nama_agenda' => 'Rapat Koordinasi', 'deadline' => '2024-11-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan dosen dan mahasiswa', 'icon' => 'kegiatan/icon4.png'],
            ['kegiatan_id' => 2, 'user_id' => 44, 'nama_agenda' => 'Rapat Evaluasi', 'deadline' => '2024-11-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi tentang tema kegiatan', 'icon' => 'kegiatan/icon5.png'],
            ['kegiatan_id' => 2, 'user_id' => 56,'nama_agenda' => 'Hari Pelaksanaan', 'deadline' => '2024-11-15 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi sesi dialog', 'icon' => 'kegiatan/icon7.png'],
            
            // Kegiatan 'Coaching Clinic 2024' (Kegiatan ID = 3)
            ['kegiatan_id' => 3, 'user_id' => 47, 'nama_agenda' => 'Rapat Persiapan', 'deadline' => '2024-10-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 1.00, 'keterangan' => 'Rapat persiapan untuk kegiatan Coaching Clinic', 'icon' => 'kegiatan/icon2.png'],
            ['kegiatan_id' => 3, 'user_id' => 29, 'nama_agenda' => 'Rapat Koordinasi', 'deadline' => '2024-10-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 1.00, 'keterangan' => 'Rapat koordinasi dengan pembicara', 'icon' => 'kegiatan/icon4.png'],
            ['kegiatan_id' => 3, 'user_id' => 13, 'nama_agenda' => 'Rapat Evaluasi', 'deadline' => '2024-10-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi hasil klinik coaching', 'icon' => 'kegiatan/icon7.png'],
            ['kegiatan_id' => 3, 'user_id' => 7, 'nama_agenda' => 'Hari Pelaksanaan', 'deadline' => '2024-10-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi kegiatan', 'icon' => 'kegiatan/icon8.png'],

            // Kegiatan 'Magang Prodi D4 Teknik Informatika' (Kegiatan ID = 4)
            ['kegiatan_id' => 4, 'user_id' => 33, 'nama_agenda' => 'Rapat Persiapan', 'deadline' => '2024-09-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 1.00, 'keterangan' => 'Rapat persiapan untuk kegiatan magang D4 TI', 'icon' => 'kegiatan/icon2.png'],
            ['kegiatan_id' => 4, 'user_id' => 12, 'nama_agenda' => 'Rapat Koordinasi', 'deadline' => '2024-09-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 1.00, 'keterangan' => 'Rapat koordinasi dengan perusahaan mitra', 'icon' => 'kegiatan/icon3.png'],
            ['kegiatan_id' => 4, 'user_id' => 8, 'nama_agenda' => 'Rapat Evaluasi', 'deadline' => '2024-09-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 1.00, 'keterangan' => 'Rapat evaluasi kegiatan magang', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 4, 'user_id' => 41, 'nama_agenda' => 'Hari Pelaksanaan', 'deadline' => '2024-09-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi proses magang', 'icon' => 'kegiatan/icon1.png'],

            // Kegiatan 'Magang Prodi D4 Sistem Informasi Bisnis' (Kegiatan ID = 5)
            ['kegiatan_id' => 5, 'user_id' => 43, 'nama_agenda' => 'Rapat Persiapan', 'deadline' => '2024-08-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 1.00, 'keterangan' => 'Rapat persiapan untuk kegiatan magang D4 SIB', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 5, 'user_id' => 32, 'nama_agenda' => 'Rapat Koordinasi', 'deadline' => '2024-08-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 1.00, 'keterangan' => 'Rapat koordinasi dengan perusahaan mitra', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 5, 'user_id' => 18, 'nama_agenda' => 'Rapat Evaluasi', 'deadline' => '2024-08-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi kegiatan magang', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 5, 'user_id' => 52, 'nama_agenda' => 'Hari Pelaksanaan', 'deadline' => '2024-08-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi proses magang', 'icon' => 'kegiatan/icon1.png'],
            
            // Kegiatan 'Intercomp 2024' (Kegiatan ID = 6)
            ['kegiatan_id' => 6, 'user_id' => 31, 'nama_agenda' => 'Rapat Persiapan', 'deadline' => '2024-07-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 1.00, 'keterangan' => 'Rapat persiapan untuk kegiatan Intercomp', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 6, 'user_id' => 39, 'nama_agenda' => 'Rapat Koordinasi', 'deadline' => '2024-07-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 1.00, 'keterangan' => 'Rapat koordinasi dengan tim', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 6, 'user_id' => 23, 'nama_agenda' => 'Rapat Evaluasi', 'deadline' => '2024-07-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi tentang hasil persiapan kegiatan', 'icon' => 'kegiatan/icon1.png'],
            ['kegiatan_id' => 6, 'user_id' => 45, 'nama_agenda' => 'Hari Pelaksanaan', 'deadline' => '2024-07-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi kegiatan', 'icon' => 'kegiatan/icon1.png'],

        ];

        // Insert data ke dalam tabel kegiatan_agenda
        DB::table('t_kegiatan_agenda')->insert($data);
    }
}