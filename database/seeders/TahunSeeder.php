<?php

namespace Database\Seeders;

use App\Models\TahunModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    public function run()
    {
        $tahun = [
            [
                'tahun' => '2022'
            ],
            [
                'tahun' => '2023'
            ],
            [
                'tahun' => '2024'
            ]
        ];

        foreach ($tahun as $tahun) {
            TahunModel::create($tahun);
        }
    }
}
