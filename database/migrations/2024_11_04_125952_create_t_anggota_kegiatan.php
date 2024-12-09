<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     //User_id -> nama anggota diambil dari tabel m_user
    //kegiatan_id -> detail kegiatan diambil dari tabel t_kegiatan
    //jabatan -> PIC, Sekretaris, Bendahara, Anggota
    //skor -> seharusnya sesuai tabel m_bobot_jabatan
    public function up(): void
    {
        Schema::create('t_anggota_kegiatan', function (Blueprint $table) {
            $table->id('anggota_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('kegiatan_id')->index();
           $table->enum('jabatan', ['PIC', 'Sekretaris', 'Bendahara', 'Anggota']); // Enum untuk jabatan
            $table->decimal('skor', 4, 2);

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('t_kegiatan');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_anggota_kegiatan');
    }
};
