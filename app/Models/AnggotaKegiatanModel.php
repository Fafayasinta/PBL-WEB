<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggotaKegiatanModel extends Model
{
    protected $table = 't_anggota_kegiatan';
    protected $primaryKey = 'anggota_id';
    
    protected $fillable = [
        'user_id',
        'kegiatan_id', 
        'jabatan',
        'beban_kerja'
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke Kegiatan 
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }
}