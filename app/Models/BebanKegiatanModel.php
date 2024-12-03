<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BebanKegiatanModel extends Model
{
    protected $table = 'm_beban_kegiatan';
    protected $primaryKey = 'beban_kegiatan_id';
    
    protected $fillable = [
        'nama_beban',
        'deskripsi'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function kegiatan() :HasMany
    {
        return $this->hasMany(KegiatanModel::class, 'beban_kegiatan_id', 'beban_kegiatan_id');
    }
}
