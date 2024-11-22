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
            ['kegiatan_id' => 1, 'deadline' => '2024-12-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 0.00, 'keterangan' => 'Rapat persiapan awal untuk kegiatan JTI Play IT!'],
            ['kegiatan_id' => 1, 'deadline' => '2024-12-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan panitia utama'],
            ['kegiatan_id' => 1, 'deadline' => '2024-12-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi tahapan kegiatan'],
            ['kegiatan_id' => 1, 'deadline' => '2024-12-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi kegiatan secara langsung'],

            // Kegiatan 'Dialog Dosen Mahasiswa 2024' (Kegiatan ID = 2)
            ['kegiatan_id' => 2, 'deadline' => '2024-11-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 0.00, 'keterangan' => 'Rapat persiapan awal untuk kegiatan Dialog Dosen Mahasiswa'],
            ['kegiatan_id' => 2, 'deadline' => '2024-11-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan dosen dan mahasiswa'],
            ['kegiatan_id' => 2, 'deadline' => '2024-11-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi tentang tema kegiatan'],
            ['kegiatan_id' => 2, 'deadline' => '2024-11-15 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi sesi dialog'],
            
            // Kegiatan 'Coaching Clinic 2024' (Kegiatan ID = 3)
            ['kegiatan_id' => 3, 'deadline' => '2024-10-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 0.00, 'keterangan' => 'Rapat persiapan untuk kegiatan Coaching Clinic'],
            ['kegiatan_id' => 3, 'deadline' => '2024-10-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan pembicara'],
            ['kegiatan_id' => 3, 'deadline' => '2024-10-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi hasil klinik coaching'],
            ['kegiatan_id' => 3, 'deadline' => '2024-10-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi kegiatan'],

            // Kegiatan 'Magang Prodi D4 Teknik Informatika' (Kegiatan ID = 4)
            ['kegiatan_id' => 4, 'deadline' => '2024-09-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 0.00, 'keterangan' => 'Rapat persiapan untuk kegiatan magang D4 TI'],
            ['kegiatan_id' => 4, 'deadline' => '2024-09-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan perusahaan mitra'],
            ['kegiatan_id' => 4, 'deadline' => '2024-09-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi kegiatan magang'],
            ['kegiatan_id' => 4, 'deadline' => '2024-09-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi proses magang'],

            // Kegiatan 'Magang Prodi D4 Sistem Informasi Bisnis' (Kegiatan ID = 5)
            ['kegiatan_id' => 5, 'deadline' => '2024-08-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 0.00, 'keterangan' => 'Rapat persiapan untuk kegiatan magang D4 SIB'],
            ['kegiatan_id' => 5, 'deadline' => '2024-08-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan perusahaan mitra'],
            ['kegiatan_id' => 5, 'deadline' => '2024-08-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi kegiatan magang'],
            ['kegiatan_id' => 5, 'deadline' => '2024-08-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi proses magang'],
            
            // Kegiatan 'Intercomp 2024' (Kegiatan ID = 6)
            ['kegiatan_id' => 6, 'deadline' => '2024-07-01 10:00:00', 'lokasi' => 'Ruang Rapat A', 'progres' => 0.00, 'keterangan' => 'Rapat persiapan untuk kegiatan Intercomp'],
            ['kegiatan_id' => 6, 'deadline' => '2024-07-05 14:00:00', 'lokasi' => 'Ruang Koordinasi B', 'progres' => 0.00, 'keterangan' => 'Rapat koordinasi dengan tim'],
            ['kegiatan_id' => 6, 'deadline' => '2024-07-10 09:00:00', 'lokasi' => 'Ruang Evaluasi C', 'progres' => 0.00, 'keterangan' => 'Rapat evaluasi tentang hasil persiapan kegiatan'],
            ['kegiatan_id' => 6, 'deadline' => '2024-07-12 16:00:00', 'lokasi' => 'Outdoor Area', 'progres' => 0.00, 'keterangan' => 'Briefing dan simulasi kegiatan'],
        ];

        // Insert data ke dalam tabel kegiatan_agenda
        DB::table('kegiatan_agenda')->insert($data);
    }
}
