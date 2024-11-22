<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kategori_kegiatan')->insert([
            [
                'kategori_kegiatan_id' => 1,
                'nama_kategori' => 'JTI Terprogram',
                'deskripsi' => 'Kegiatan yang telah direncanakan dan terorganisir di lingkup JTI.',
                'created_at' => now(),
            ],
            [
                'kategori_kegiatan_id' => 2,
                'nama_kategori' => 'JTI Non Program',
                'deskripsi' => 'Kegiatan tambahan yang tidak termasuk dalam program utama JTI namun dilakukan dilingkup JTI.',
                'created_at' => now(),
            ],
            [
                'kategori_kegiatan_id' => 3,
                'nama_kategori' => 'Non JTI',
                'deskripsi' => 'Kegiatan yang dilakukan di luar lingkup JTI.',
                'created_at' => now(),
            ],
        ]);
    }
}
