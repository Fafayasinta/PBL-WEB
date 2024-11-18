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
        Schema::create('t_dokumen', function (Blueprint $table) {
            $table->id('dokumen_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('nama_dokumen',255);
            $table->string('jenis_dokumen',255);
            $table->timestamp('uploaded_at')->useCurrent();
            $table->boolean('is_verified')->default(false);

            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_dokumen');
    }
};
