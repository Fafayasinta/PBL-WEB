<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 't_kegiatan';
    protected $primaryKey = 'kegiatan_id';

    protected $fillable = [
        'kategori_kegiatan_id',
        'user_id',
        'nama_kegiatan',
        'pic',
        'waktu_mulai',
        'waktu_selesai',
        'deadline',
        'status',
        'progres',
        'deskripsi',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'deadline' => 'datetime',
        'progres' => 'decimal:2',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke model KategoriKegiatan
    public function kategori_kegiatan()
{
    return $this->belongsTo(KategoriKegiatanModel::class, 'kategori_kegiatan_id', 'id');
}

public function beban_kegiatan()
{
    return $this->hasOne(BebanKegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
}

    public function kegiatanDosen()
    {
        return $this->hasMany(KegiatanDosenModel::class, 'kegiatan_dosen_id', 'kegiatan_dosen_id');
    }
}