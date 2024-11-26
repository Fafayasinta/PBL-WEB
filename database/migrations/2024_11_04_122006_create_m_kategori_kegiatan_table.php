<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        //Ini nanti isinya JTI Terprogram, JTI Non Program, Non JTI
    //Kategori Kegiatan : JTI-P , JTI-NonP , NonJTI
    //Nama Kategori : JTI Terprogram, JTI Non Program, Non JTI

    public function up(): void
    {
        Schema::create('m_kategori_kegiatan', function (Blueprint $table) {
            $table->id('kategori_kegiatan_id');
            $table->string('nama_kategori', 100)->unique();
            $table->text('deskripsi');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_kategori_kegiatan');
    }
};