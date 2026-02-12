<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
    |--------------------------------------------------------------------------
    | HELPER ROLE
    |--------------------------------------------------------------------------
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
    |--------------------------------------------------------------------------
    | IDENTIFIER LOGIN
    |--------------------------------------------------------------------------
    */
    public function getLoginIdentifierAttribute(): string
    {
        return in_array($this->role, ['admin', 'pembimbing'])
            ? $this->username
            : $this->nis;
    }

    /*
    |--------------------------------------------------------------------------
    | NAMA TAMPILAN
    |--------------------------------------------------------------------------
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
    |--------------------------------------------------------------------------
    | ACCESSOR NAMA PEMBIMBING
    |--------------------------------------------------------------------------
    */
    public function getNamaPembimbingAttribute()
    {
        return $this->pembimbing ? $this->pembimbing->nama : '-';
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPE ROLE
    |--------------------------------------------------------------------------
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
    |--------------------------------------------------------------------------
    | RELASI TEMPAT PKL
    |--------------------------------------------------------------------------
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
    |--------------------------------------------------------------------------
    | RELASI PEMBIMBING (SISWA -> PEMBIMBING)
    |--------------------------------------------------------------------------
    */
    public function pembimbing()
    {
        return $this->belongsTo(
            MsUser::class,
            'pembimbing_id',
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI SISWA BIMBINGAN (PEMBIMBING -> SISWA)
    |--------------------------------------------------------------------------
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
    |--------------------------------------------------------------------------
    | RELASI CHAT / BIMBINGAN
    |--------------------------------------------------------------------------
    */

    // Semua pesan milik siswa (dipakai di halaman pembimbing)
    public function bimbinganMessages()
    {
        return $this->hasMany(
            \App\Models\BimbinganMessage::class,
            'siswa_id',
            'user_id'
        );
    }

    // Pesan yang dikirim siswa
    public function pesanSiswa()
    {
        return $this->hasMany(
            \App\Models\BimbinganMessage::class,
            'siswa_id',
            'user_id'
        );
    }

    // Pesan yang dikirim pembimbing
    public function pesanPembimbing()
    {
        return $this->hasMany(
            \App\Models\BimbinganMessage::class,
            'pembimbing_id',
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CHAT BELUM DIBACA (UNTUK TITIK MERAH)
    |--------------------------------------------------------------------------
    */
    public function chatBelumDibaca()
    {
        return $this->hasMany(
            \App\Models\BimbinganMessage::class,
            'siswa_id',
            'user_id'
        )->where('dibaca', false);
    }

    /*
    |--------------------------------------------------------------------------
    | KEAMANAN HAPUS PEMBIMBING
    |--------------------------------------------------------------------------
    */
    public function canBeDeleted(): bool
    {
        if ($this->role === 'pembimbing') {
            return $this->siswaBimbingan()->count() === 0;
        }

        return true;
    }
}
