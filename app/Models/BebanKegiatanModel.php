<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
