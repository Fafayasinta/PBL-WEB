<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BebanKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_beban_kegiatan')->insert([
            [
                'beban_kegiatan_id' => 1,
                'nama_beban' => 'Berat',
                'deskripsi' => 'Kegiatan ini dinilai berat dikarenakan agenda yang banyak, cakupan yang luas, timeline panjang, dan beban kerja tinggi.',
                'created_at' => now(),
            ],
            [
                'beban_kegiatan_id' => 2,
                'nama_beban' => 'Sedang',
                'deskripsi' => 'Kegiatan ini dinilai sedang dengan agenda yang terukur, cakupan moderat, dan timeline yang cukup fleksibel.',
                'created_at' => now(),
            ],
            [
                'beban_kegiatan_id' => 3,
                'nama_beban' => 'Ringan',
                'deskripsi' => 'Kegiatan ini dinilai ringan dengan sedikit agenda, cakupan kecil, dan timeline yang singkat.',
                'created_at' => now(),
            ],
        ]);
    }
}