<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
      //Inputan skor apakah mungkin bisa dropdown yah nanti ? sesuai table m_bobot_jabatan
     //user_id -> id dari m_user
     //beban_kegiatan -> Sangat Berat/Berat/Cukup/Ringan/Sangat Ringan
     //kegiatan_id -> nama kegiatan yang diikuti apa diambil dari tabel t_kegiatan
     //skor -> diambil dari t_anggota_kegiatan untuk setiap kegiatan
     //waktu mulai -> dari t_kegiatan
     //waktu selesai -> dari t_kegiatan
    public function up(): void
    {
        Schema::create('t_bobot_dosen', function (Blueprint $table) {
            $table->id('bobot_dosen_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('beban_kegiatan_id')->index();
            $table->unsignedBigInteger('kegiatan_id')->index();
            $table->decimal('skor', 4, 2);
            $table->date('waktu_mulai');
            $table->date('waktu_selesai');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('beban_kegiatan_id')->references('beban_kegiatan_id')->on('m_beban_kegiatan');
            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('t_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_bobot_dosen');
    }
};
