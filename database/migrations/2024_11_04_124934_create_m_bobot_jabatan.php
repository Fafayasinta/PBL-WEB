<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Luar Institusi	
    // Ketua Pelaksana	5
    // Sekretaris	4
    // Bendahara	4
    // Anggota	3

    // Institusi	
    // Ketua Pelaksana	4
    // Sekretaris	3,5
    // Bendahara	3,5
    // Anggota	3

    // Jurusan	
    // Ketua Pelaksana	3
    // Sekretaris	2,5
    // Bendahara	2,5
    // Anggota	2

    // Program Studi	
    // Ketua Pelaksana	3
    // Sekretaris	2,5
    // Bendahara	2,5
    // Anggota	2
    public function up(): void
    {
        Schema::create('m_bobot_jabatan', function (Blueprint $table) {
            $table->bigIncrements('bobot_jabatan_id'); // Primary key
            $table->enum('cakupan_wilayah', ['Luar Institusi','Institusi','Jurusan','Program Studi']); // String untuk cakupan wilayah
            $table->enum('jabatan', ['PIC', 'Sekretaris', 'Bendahara', 'Anggota']); // Enum untuk jabatan
            $table->decimal('skor', 4, 2); // Integer untuk skor
            $table->timestamps(); // Timestamps default
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_bobot_jabatan');
    }
};