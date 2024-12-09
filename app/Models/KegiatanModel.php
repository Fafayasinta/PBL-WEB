<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    public function kategori() :BelongsTo
    {
        return $this->belongsTo(KategoriKegiatanModel::class, 'kategori_kegiatan_id', 'kategori_kegiatan_id');
    }

    public function beban() :BelongsTo
    {
        return $this->belongsTo(BebanKegiatanModel::class, 'beban_kegiatan_id', 'beban_kegiatan_id');
    }

    public function tahun() :BelongsTo
    {
        return $this->belongsTo(TahunModel::class, 'tahun_id', 'tahun_id');
    }

    public function anggota() :HasMany
    {
        return $this->hasMany(AnggotaKegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }
}