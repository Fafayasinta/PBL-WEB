<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
        LevelSeeder::class,
        UserSeeder::class,
        KategoriKegiatanSeeder::class,
        BebanKegiatanSeeder::class,
        KegiatanSeeder::class,
        KegiatanDosenSeeder::class,
    ]);
}
}