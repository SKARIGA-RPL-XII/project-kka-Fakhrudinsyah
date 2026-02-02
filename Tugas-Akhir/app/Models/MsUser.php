<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\TempatPkl;

class MsUser extends Authenticatable
{
    protected $table = 'msuser';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'username',
        'nis',
        'password',
        'role',
        'tempat_pkl_id',
        'pembimbing_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |------------------------------------------------------------------
    | HELPER ROLE
    |------------------------------------------------------------------
    */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPembimbing(): bool
    {
        return $this->role === 'pembimbing';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    /*
    |------------------------------------------------------------------
    | IDENTIFIER LOGIN
    |------------------------------------------------------------------
    */
    public function getLoginIdentifierAttribute(): string
    {
        return in_array($this->role, ['admin', 'pembimbing'])
            ? $this->username
            : $this->nis;
    }

    /*
    |------------------------------------------------------------------
    | NAMA TAMPILAN
    |------------------------------------------------------------------
    */
    public function getDisplayNameAttribute(): string
    {
        return $this->nama;
    }

    public function getNamaLengkapAttribute(): string
    {
        return $this->nama;
    }

    /*
    |------------------------------------------------------------------
    | QUERY SCOPE ROLE
    |------------------------------------------------------------------
    */
    public function scopeRoleAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeRolePembimbing($query)
    {
        return $query->where('role', 'pembimbing');
    }

    public function scopeRoleSiswa($query)
    {
        return $query->where('role', 'siswa');
    }

    /*
    |------------------------------------------------------------------
    | RELASI TEMPAT PKL
    |------------------------------------------------------------------
    */
    public function tempatPkl()
    {
        return $this->belongsTo(
            TempatPkl::class,
            'tempat_pkl_id',
            'tempat_pkl_id'
        );
    }

    /*
    |------------------------------------------------------------------
    | RELASI PEMBIMBING (RENAMED)
    |------------------------------------------------------------------
    */
    public function pembimbingUser()
    {
        return $this->belongsTo(
            MsUser::class,
            'pembimbing_id',
            'user_id'
        );
    }

    /*
    |------------------------------------------------------------------
    | RELASI SISWA BIMBINGAN
    |------------------------------------------------------------------
    */
    public function siswaBimbingan()
    {
        return $this->hasMany(
            MsUser::class,
            'pembimbing_id',
            'user_id'
        );
    }

    /*
    |------------------------------------------------------------------
    | KEAMANAN HAPUS PEMBIMBING
    |------------------------------------------------------------------
    */
    public function canBeDeleted(): bool
    {
        if ($this->role === 'pembimbing') {
            return $this->siswaBimbingan()->count() === 0;
        }

        return true;
    }
}
