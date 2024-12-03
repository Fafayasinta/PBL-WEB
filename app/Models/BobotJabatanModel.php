<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotJabatanModel extends Model
{
    protected $table = 'm_bobot_jabatan';
    protected $primaryKey = 'bobot_jabatan_id';
    public $timestamps = true;
    const UPDATED_AT = null; 
    const CREATED_AT = null; 

    protected $fillable = [
        'cakupan_wilayah',
        'jabatan',
        'skor'
    ];

    // Jika Anda ingin menambahkan validasi di model
    // public static $rules = [
    //     'nama_bobot' => 'required|string|max:100|unique:m_bobot_kegiatan',
    //     'deskripsi' => 'required|string'
    // ];
}