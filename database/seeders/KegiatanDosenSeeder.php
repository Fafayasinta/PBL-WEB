<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class KegiatanDosenSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID user berdasarkan nama
        $dika = UserModel::where('nama', 'like', '%Dika Rizky%')->first()->user_id;
        $vivi = UserModel::where('nama', 'like', '%Vivi Nur%')->first()->user_id;
        $zawaruddin = UserModel::where('nama', 'like', '%Zawaruddin%')->first()->user_id;
        $ely = UserModel::where('nama', 'like', '%Ely Setyo%')->first()->user_id;
        $faiz = UserModel::where('nama', 'like', '%Faiz Ushbah%')->first()->user_id;
        $meyti = UserModel::where('nama', 'like', '%Meyti Eka%')->first()->user_id;
        $mungki = UserModel::where('nama', 'like', '%Mungki%')->first()->user_id;
        $annisa = UserModel::where('nama', 'like', '%Annisa Puspa%')->first()->user_id;
        $atiqah = UserModel::where('nama', 'like', '%Atiqah Nurul%')->first()->user_id;
        $dimas = UserModel::where('nama', 'like', '%Dimas Wahyu%')->first()->user_id;
        $rudy = UserModel::where('nama', 'like', '%Rudy Ariyanto%')->first()->user_id;
        $mustika = UserModel::where('nama', 'like', '%Mustika Mentari%')->first()->user_id;
        $banni = UserModel::where('nama', 'like', '%Banni Satria%')->first()->user_id;
        $dhebys = UserModel::where('nama', 'like', '%Dhebys%')->first()->user_id;
        $widaningsih = UserModel::where('nama', 'like', '%Widaningsih%')->first()->user_id;
        $vivin = UserModel::where('nama', 'like', '%Vivin Ayu%')->first()->user_id;
        $erfan = UserModel::where('nama', 'like', '%Erfan Rohadi%')->first()->user_id;
        $usman = UserModel::where('nama', 'like', '%Usman Nurhasan%')->first()->user_id;
        $kadek = UserModel::where('nama', 'like', '%Kadek%')->first()->user_id;
        $afif = UserModel::where('nama', 'like', '%Afif Hendrawan%')->first()->user_id;
        $luqman = UserModel::where('nama', 'like', '%Luqman%')->first()->user_id;
        $arie = UserModel::where('nama', 'like', '%Arie Rachmad%')->first()->user_id;
        $ulla = UserModel::where('nama', 'like', '%Ulla%')->first()->user_id;

        $data = [
            // JTI Play IT!
            ['user_id' => $dika, 'kegiatan_id' => 1, 'jabatan' => 'PIC', 'skor' => 5.00, 'deadline' => '2024-12-05 12:00:00'],
            ['user_id' => $vivi, 'kegiatan_id' => 1, 'jabatan' => 'Sekretaris', 'skor' => 4.00, 'deadline' => '2024-12-05 12:00:00'],
            ['user_id' => $zawaruddin, 'kegiatan_id' => 1, 'jabatan' => 'Bendahara', 'skor' => 4.00, 'deadline' => '2024-12-05 12:00:00'],
            ['user_id' => $ely, 'kegiatan_id' => 1, 'jabatan' => 'Anggota', 'skor' => 3.00, 'deadline' => '2024-12-05 12:00:00'],

            // Dialog Dosen Mahasiswa 2024
            ['user_id' => $faiz, 'kegiatan_id' => 2, 'jabatan' => 'PIC', 'skor' => 3.00, 'deadline' => '2024-11-20 15:00:00'],
            ['user_id' => $meyti, 'kegiatan_id' => 2, 'jabatan' => 'Sekretaris', 'skor' => 2.50, 'deadline' => '2024-11-20 15:00:00'],
            ['user_id' => $mungki, 'kegiatan_id' => 2, 'jabatan' => 'Bendahara', 'skor' => 2.50, 'deadline' => '2024-11-20 15:00:00'],
            ['user_id' => $annisa, 'kegiatan_id' => 2, 'jabatan' => 'Anggota', 'skor' => 2.00, 'deadline' => '2024-11-20 15:00:00'],

            // Dan seterusnya untuk kegiatan lain...

            // Programmer Puskom
            ['user_id' => $zawaruddin, 'kegiatan_id' => 7, 'jabatan' => 'PIC', 'skor' => 4.00, 'deadline' => '2024-12-30 13:00:00'],

            // Upskilling Training
            ['user_id' => $banni, 'kegiatan_id' => 8, 'jabatan' => 'PIC', 'skor' => 5.00, 'deadline' => '2024-11-30 10:00:00']
        ];

        DB::table('t_kegiatan_dosen')->insert($data);
    }
}