<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_anggota_kegiatan', function (Blueprint $table) {
            $table->id('anggota_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('kegiatan_id')->index();
            $table->enum('jabatan', ['PIC', 'ANGGOTA']);
            $table->float('beban_kerja');

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
