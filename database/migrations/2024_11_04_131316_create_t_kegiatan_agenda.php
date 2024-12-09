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
        Schema::create('t_kegiatan_agenda', function (Blueprint $table) {
            $table->id('agenda_id');
            $table->unsignedBigInteger('kegiatan_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('nama_agenda');
            $table->date('deadline');  
            $table->string('lokasi');
            $table->decimal('progres', 8, 2);
            $table->text('keterangan');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('t_kegiatan');
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_kegiatan_agenda');
    }
};
