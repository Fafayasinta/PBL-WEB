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
    //Judul : Reminder H-3 Rapat Koordinasi bersama Pimpinan
    //Deskripsi : Rapat dilaksanakan di Ruang Ketua Jurusan JTI pada pukul 18.00
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('notif_id');
            $table->foreignId('kegiatan_id')->constrained('t_kegiatan', 'kegiatan_id')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('judul');
            $table->text('deskripsi');
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
