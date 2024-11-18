<?php

namespace Database\Seeders;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan ID level yang sudah ada
        $adminLevel = LevelModel::where('level_kode', 'ADMIN')->first()->level_id;
        $pimpinanLevel = LevelModel::where('level_kode', 'PIMPINAN')->first()->level_id;
        $dosenLevel = LevelModel::where('level_kode', 'DOSEN')->first()->level_id;

        // Data user default
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama' => 'Administrator',
                'nip' => '123456789',
                'email' => 'admin@example.com',
                'level_id' => $adminLevel,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'pimpinan',
                'password' => Hash::make('pimpinan123'),
                'nama' => 'Dr. Budi Santoso, M.Pd.',
                'nip' => '987654321',
                'email' => 'pimpinan@example.com',
                'level_id' => $pimpinanLevel,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'dosen1',
                'password' => Hash::make('dosen123'),
                'nama' => 'Ani Wijaya, S.Pd., M.Pd.',
                'nip' => '456789123',
                'email' => 'dosen1@example.com',
                'level_id' => $dosenLevel,
                'email_verified_at' => now(),
            ],
            [
                'username' => 'dosen2',
                'password' => Hash::make('dosen123'),
                'nama' => 'Dr. Citra Dewi, M.Si.',
                'nip' => '789123456',
                'email' => 'dosen2@example.com',
                'level_id' => $dosenLevel,
                'email_verified_at' => now(),
            ]
        ];

        // Insert users with validation
        foreach ($users as $user) {
            if (!UserModel::where('username', $user['username'])->exists()) {
                UserModel::create($user);
            }
        }

        // Membuat 10 dosen tambahan menggunakan Faker
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 3; $i <= 12; $i++) {
            $username = 'dosen' . $i;
            if (!UserModel::where('username', $username)->exists()) {
                UserModel::create([
                    'username' => $username,
                    'password' => Hash::make('dosen123'),
                    'nama' => $faker->name,
                    'nip' => $faker->unique()->numerify('##########'),
                    'email' => $faker->unique()->safeEmail,
                    'level_id' => $dosenLevel,
                    'email_verified_at' => now(),
                ]);
            }
        }
    }
}
