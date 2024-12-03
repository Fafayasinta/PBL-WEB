<?php
// app/Models/KegiatanDosen.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanDosenModel extends Model
{
    protected $table = 't_kegiatan_dosen';
    protected $primaryKey = 'kegiatan_dosen_id';
    
    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'deadline',
        'jabatan',
        'beban_kerja'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'beban_kerja' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi dengan model Kegiatan
    public function kegiatan()
    {
        // Relasi ke model Kegiatan tanpa menyebutkan 'cakupan_wilayah' di sini
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_id', 'kegiatan_id');
    }
}