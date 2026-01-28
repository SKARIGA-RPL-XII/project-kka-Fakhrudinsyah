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

    /**
     * ===============================
     * RELASI TEMPAT PKL
     * ===============================
     * Siswa -> satu Tempat PKL
     */
    public function tempatPkl()
    {
        return $this->belongsTo(
            TempatPkl::class,
            'tempat_pkl_id', // FK di msuser
            'tempat_pkl_id'             // PK di tempat_pkl
        );
    }

    /**
     * ===============================
     * RELASI PEMBIMBING
     * ===============================
     * Siswa -> satu Pembimbing
     */
    public function pembimbing()
    {
        return $this->belongsTo(
            MsUser::class,
            'pembimbing_id', // FK di msuser
            'user_id'        // PK pembimbing
        );
    }

    /**
     * ===============================
     * RELASI SISWA BIMBINGAN
     * ===============================
     * Pembimbing -> banyak Siswa
     */
    public function siswaBimbingan()
    {
        return $this->hasMany(
            MsUser::class,
            'pembimbing_id', // FK di msuser
            'user_id'        // PK pembimbing
        );
    }
}
