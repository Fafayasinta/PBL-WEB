<?php
namespace Database\Seeders;

use App\Models\LevelModel;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $levels = [
            [
                'level_kode' => 'ADMIN',
                'level_nama' => 'Administrator',
                'level_deskripsi' => 'Administrator sistem dengan akses penuh'
            ],
            [
                'level_kode' => 'PIMPINAN',
                'level_nama' => 'Pimpinan',
                'level_deskripsi' => 'Pimpinan dengan akses monitoring'
            ],
            [
                'level_kode' => 'DOSEN',
                'level_nama' => 'Dosen',
                'level_deskripsi' => 'Dosen dengan akses terbatas'
            ]
        ];

        foreach ($levels as $level) {
            LevelModel::create($level);
        }
    }
}