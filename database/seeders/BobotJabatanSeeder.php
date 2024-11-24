<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BobotJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Luar Institusi
            ['cakupan_wilayah' => 'Luar Institusi', 'jabatan' => 'PIC', 'skor' => 5.00],
            ['cakupan_wilayah' => 'Luar Institusi', 'jabatan' => 'Sekretaris', 'skor' => 4.00],
            ['cakupan_wilayah' => 'Luar Institusi', 'jabatan' => 'Bendahara', 'skor' => 4.00],
            ['cakupan_wilayah' => 'Luar Institusi', 'jabatan' => 'Anggota', 'skor' => 3.00],

            // Institusi
            ['cakupan_wilayah' => 'Institusi', 'jabatan' => 'PIC', 'skor' => 4.00],
            ['cakupan_wilayah' => 'Institusi', 'jabatan' => 'Sekretaris', 'skor' => 3.50],
            ['cakupan_wilayah' => 'Institusi', 'jabatan' => 'Bendahara', 'skor' => 3.50],
            ['cakupan_wilayah' => 'Institusi', 'jabatan' => 'Anggota', 'skor' => 3.00],

            // Jurusan
            ['cakupan_wilayah' => 'Jurusan', 'jabatan' => 'PIC', 'skor' => 3.00],
            ['cakupan_wilayah' => 'Jurusan', 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['cakupan_wilayah' => 'Jurusan', 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['cakupan_wilayah' => 'Jurusan', 'jabatan' => 'Anggota', 'skor' => 2.00],

            // Program Studi
            ['cakupan_wilayah' => 'Program Studi', 'jabatan' => 'PIC', 'skor' => 3.00],
            ['cakupan_wilayah' => 'Program Studi', 'jabatan' => 'Sekretaris', 'skor' => 2.50],
            ['cakupan_wilayah' => 'Program Studi', 'jabatan' => 'Bendahara', 'skor' => 2.50],
            ['cakupan_wilayah' => 'Program Studi', 'jabatan' => 'Anggota', 'skor' => 2.00],
        ];

        // Insert data ke database
        DB::table('m_bobot_jabatan')->insert($data);
    }
}