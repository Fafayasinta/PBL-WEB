<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'notif_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
