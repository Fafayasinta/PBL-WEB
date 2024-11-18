<?php

// app/Models/BobotDosen.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotDosenModel extends Model
{
    protected $table = 't_bobot_dosen';
    protected $primaryKey = 'bobot_dosen_id';
    
    protected $fillable = [
        'user_id',
        'bobot_kegiatan_id',
        'nilai_bobot',
        'waktu_mulai',
        'waktu_selesai'
    ];

    protected $casts = [
        'nilai_bobot' => 'decimal:2',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke model BobotKegiatan
    public function bobotKegiatan()
    {
        return $this->belongsTo(BobotKegiatanModel::class, 'bobot_kegiatan_id', 'bobot_kegiatan_id');
    }
}