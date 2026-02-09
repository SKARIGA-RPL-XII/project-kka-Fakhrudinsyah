<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnal'; // WAJIB karena nama tabel singular

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'judul',
        'kegiatan',
        'status',
        'catatan_pembimbing'
    ];

    public function siswa()
    {
        return $this->belongsTo(MsUser::class, 'siswa_id', 'user_id');
    }
}
