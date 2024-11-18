<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('t_kegiatan', function (Blueprint $table) {
            $table->id('kegiatan_id');
            $table->unsignedBigInteger('kategori_kegiatan_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('nama_kegiatan', 200);
            $table->string('pic', 100);  
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->dateTime('deadline');  
            $table->string('status', 20);
            $table->decimal('progres', 8, 2);  
            $table->text('deskripsi');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('kategori_kegiatan_id')->references('kategori_kegiatan_id')->on('m_kategori_kegiatan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_kegiatan');
    }
};