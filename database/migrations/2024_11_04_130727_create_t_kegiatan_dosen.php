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
        Schema::create('t_kegiatan_dosen', function (Blueprint $table) {
            $table->id('kegiatan_dosen_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('kegiatan_id')->index();
            $table->date('deadline');  
            $table->enum('jabatan', ['PIC', 'Sekretaris', 'Bendahara', 'Anggota']); // Enum untuk jabatan
            $table->decimal('skor', 4, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('t_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_kegiatan_dosen');
    }
};
