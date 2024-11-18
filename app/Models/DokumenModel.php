<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenModel extends Model
{
    protected $table = 't_dokumen';
    protected $primaryKey = 'dokumen_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_dokumen',
        'jenis_dokumen',
        'uploaded_at',
        'is_verified'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'is_verified' => 'boolean'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}