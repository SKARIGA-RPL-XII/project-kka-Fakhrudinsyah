<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BimbinganMessage extends Model
{
    protected $fillable = [
        'siswa_id',
        'pembimbing_id',
        'pesan',
        'file',
        'dibaca',
    ];

    public function siswa()
    {
        return $this->belongsTo(MsUser::class, 'siswa_id', 'user_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(MsUser::class, 'pembimbing_id', 'user_id');
    }
}
