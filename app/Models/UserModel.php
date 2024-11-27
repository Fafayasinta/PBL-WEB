<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Nama tabel di database
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'username',
        'password', 
        'nama',
        'nip',
        'role',
        'foto_profil',
        'email',
        'remember_token',
        'email_verified_at',
        'level_id',
    ];

    // Kolom yang disembunyikan dari output JSON
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // Casting tipe data
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke tabel level
    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    // Accessor untuk foto profil (mengembalikan default jika null)
    public function getFotoProfilAttribute($value)
    {
        return $value ?? 'default-profile.jpg';
    }

    // Mutator untuk password (hash otomatis)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Scope query untuk role
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
