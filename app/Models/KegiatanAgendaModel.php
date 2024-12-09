<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanAgendaModel extends Model
{
    protected $table = 't_kegiatan_agenda';
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'kegiatan_id',
        'deadline',
        'lokasi',
        'progres',
        'user_id',
        'keterangan'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'progres' => 'decimal:2'
    ];

    // Relasi ke tabel t_kegiatan
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
