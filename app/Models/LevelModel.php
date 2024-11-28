<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id';

    protected $fillable = [
        'level_kode',
        'level_nama',
        'level_deskripsi'
    ];

    // Relasi ke User
    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }

    // Helper method untuk mendapatkan semua level
    // public static function getAllLevels()
    // {
    //     return self::pluck('level_nama', 'level_id');
    // }
}