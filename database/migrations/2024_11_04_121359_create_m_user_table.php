<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('level_id')->constrained('m_level', 'level_id')->index(); // Menghubungkan ke m_level
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('nama', 100);
            $table->string('nip', 50)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto_profil')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
}