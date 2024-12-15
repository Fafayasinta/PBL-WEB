<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    //Ini nanti list nama kegiatan dan detailnya
    //nama_kegiatan : JTI Play IT!
    //kategori_kegiatan : JTI Terprogram -> Ambil dari tabel m_kategori
    //PIC : Dika Rizky Yunianto
    //cakupan_wilayah : Luar Institusi
    //Waktu mulai : 1 Oktober 2024
    //Waktu akhir : 3 November 2024
    //Deadline : 10 November 2024
    //Status :enum('status', ['Belum Proses','Proses','Selesai'])
    //Progress : 80% (0,8)
    //Deskripsi : Kurang LPJ
return new class extends Migration
{
    public function up()
    {
        Schema::create('t_kegiatan', function (Blueprint $table) {
            $table->id('kegiatan_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('kategori_kegiatan_id')->index();
            $table->unsignedBigInteger('beban_kegiatan_id')->index();
            $table->unsignedBigInteger('tahun_id')->index();
            $table->string('icon');
            $table->string('nama_kegiatan', 200);
            $table->enum('cakupan_wilayah', ['Luar Institusi','Institusi','Jurusan','Program Studi']);
            $table->text('deskripsi');
            $table->date('waktu_mulai')->nullable();
            $table->date('waktu_selesai')->nullable();
            $table->date('deadline');  

            $table->enum('status', ['Belum Proses','Proses','Selesai']);
            $table->decimal('progres', 8, 2)->nullable();  
            $table->text('keterangan')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('beban_kegiatan_id')->references('beban_kegiatan_id')->on('m_beban_kegiatan');
            $table->foreign('kategori_kegiatan_id')->references('kategori_kegiatan_id')->on('m_kategori_kegiatan');
            $table->foreign('tahun_id')->references('tahun_id')->on('m_tahun');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_kegiatan');
    }
};