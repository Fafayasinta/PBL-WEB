<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // Ini adalah bagian yang perlu ditambahkan
    protected $fillable = [
        'username', 'password', 'nama', 'nip', 'email', 'level_id', 'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

      /**
     * mendapatkan nama role
     */
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    /**
     * Mendapatkan kode role
     */
    public function getRole(): string
    {
        return $this->level->level_kode;
    }

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