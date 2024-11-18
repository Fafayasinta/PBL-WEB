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
        Schema::create('t_bobot_dosen', function (Blueprint $table) {
            $table->id('bobot_dosen_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('bobot_kegiatan_id')->index();
            $table->decimal('nilai_bobot');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('bobot_kegiatan_id')->references('bobot_kegiatan_id')->on('m_bobot_kegiatan');
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
