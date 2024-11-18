<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotKegiatanModel extends Model
{
    protected $table = 'm_bobot_kegiatan';
    protected $primaryKey = 'bobot_kegiatan_id';
    public $timestamps = true;
    const UPDATED_AT = null; // karena di tabel hanya ada created_at

    protected $fillable = [
        'nama_bobot',
        'deskripsi'
    ];

    // Jika Anda ingin menambahkan validasi di model
    public static $rules = [
        'nama_bobot' => 'required|string|max:100|unique:m_bobot_kegiatan',
        'deskripsi' => 'required|string'
    ];
}