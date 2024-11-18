<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'username',
        'password',
        'nama',
        'nip',
        'role',
        'foto_profil',
        'email',
        'remember_token',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Konstanta untuk role
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_PIMPINAN = 'PIMPINAN'; 
    const ROLE_DOSEN = 'DOSEN';

    // Accessor untuk foto profil
    public function getFotoProfilAttribute($value)
    {
        return $value ?? 'default-profile.jpg';
    }

    // Helper methods untuk check role
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPimpinan()
    {
        return $this->role === self::ROLE_PIMPINAN;
    }

    public function isDosen()
    {
        return $this->role === self::ROLE_DOSEN;
    }

    // Scope untuk query berdasarkan role
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Mutator untuk password (auto hash)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    
}