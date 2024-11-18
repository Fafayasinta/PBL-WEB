<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori_kegiatan';
    protected $primaryKey = 'kategori_kegiatan_id';
    public $timestamps = false; // karena hanya ada created_at

    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    // Relasi ke Kegiatan
    public function kegiatan()
    {
        return $this->hasMany(KegiatanModel::class, 'kategori_kegiatan_id', 'kategori_kegiatan_id');
    }
}