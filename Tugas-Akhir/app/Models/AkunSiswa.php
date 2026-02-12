<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkunSiswa extends Model
{
    protected $table = 'users'; // ambil data dari tabel users

    protected $guarded = [];

    public function tempatPkl()
    {
        return $this->belongsTo(TempatPkl::class, 'tempat_pkl_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }
}
