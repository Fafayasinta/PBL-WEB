<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 't_kegiatan';
    protected $primaryKey = 'kegiatan_id';

    protected $fillable = [
        'kategori_kegiatan_id',
        'beban_kegiatan_id',
        'user_id',
        'tahun_id',
        'nama_kegiatan',
        'cakupan_wilayah',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'deadline',
        'status',
        'progres',
        'keterangan',
    ];

    protected $casts = [
        'waktu_mulai' => 'date',
        'waktu_selesai' => 'date',
        'deadline' => 'date',
        'progres' => 'decimal:2',
    ];

    public $timestamps = true; // Atur sesuai kebutuhan

    // Relasi ke model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke model KategoriKegiatan
    public function kategoriKegiatan(): BelongsTo
    {
        return $this->belongsTo(KategoriKegiatanModel::class, 'kategori_kegiatan_id', 'kategori_kegiatan_id');
    }

    // Relasi ke model BebanKegiatan
    public function bebanKegiatan(): BelongsTo
    {
        return $this->belongsTo(BebanKegiatanModel::class, 'beban_kegiatan_id', 'beban_kegiatan_id');
    }

    // Relasi ke model Tahun
    public function tahun(): BelongsTo
    {
        return $this->belongsTo(TahunModel::class, 'tahun_id', 'tahun_id');
    }

    // Relasi ke model KegiatanAgenda
    public function agenda(): HasMany
    {
        return $this->hasMany(KegiatanAgendaModel::class, 'kegiatan_id', 'kegiatan_id');
    }

    // Relasi ke model AnggotaKegiatan
    public function anggota(): HasMany
    {
        return $this->hasMany(AnggotaKegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKegiatanModel::class, 'kategori_kegiatan_id', 'kategori_kegiatan_id');
    }

    public function beban(): BelongsTo
    {
        return $this->belongsTo(BebanKegiatanModel::class, 'beban_kegiatan_id', 'beban_kegiatan_id');
    }
}
