<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggotaKegiatanModel extends Model
{
    protected $table = 't_anggota_kegiatan';
    protected $primaryKey = 'anggota_id';
<<<<<<< HEAD
    public $timestamps = false;
    
=======

>>>>>>> 09a3213b37efd1093bf2700e7eb6dd9529a6b46f
    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'jabatan',
<<<<<<< HEAD
        'skor'
=======
        'beban_kerja',
        'skor',
    ];
    
    protected $casts = [
        'skor' => 'decimal:2',
>>>>>>> 09a3213b37efd1093bf2700e7eb6dd9529a6b46f
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
