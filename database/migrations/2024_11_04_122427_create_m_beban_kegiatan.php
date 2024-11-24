<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //Ini nanti isinya
    //Nama beban : berat, sedang, ringan
    //Deskripsi : Kegiatan ini dinilai berat dikarenakan agenda yang banyak, cakupan yang luas, timeline panjang dll
    //Bobot ini nanti nempelnya ke setiap kegiatannya
    public function up(): void
    {
        Schema::create('m_beban_kegiatan', function (Blueprint $table) {
            $table->id('beban_kegiatan_id');
            $table->string('nama_beban', 100)->unique();
            $table->text('deskripsi');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_beban_kegiatan');
    }
};
