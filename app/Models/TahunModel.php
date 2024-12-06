<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunModel extends Model
{
    protected $table = 'm_tahun';
    protected $primaryKey = 'tahun_id';
    
    protected $fillable = [
        'tahun'
    ];

    public function kegiatan(): HasMany
    {
        return $this->hasMany(KegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }
}
