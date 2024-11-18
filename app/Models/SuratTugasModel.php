<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTugasModel extends Model
{
    protected $table = 'surat_tugas';
    protected $primaryKey = 'surat_tugas_id';
    
    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'nomor_surat'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }
}