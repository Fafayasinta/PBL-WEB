<?php

namespace Database\Seeders;

use App\Models\NotifikasiModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'kegiatan_id' => 1,
                'user_id' => 42,
                'judul' => 'DIALOG DOSEN MAHASISWA',
                'deskripsi' => 'lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            ]
        ];
        NotifikasiModel::insert($datas);
    }
}
