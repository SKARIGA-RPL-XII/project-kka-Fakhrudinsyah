<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MsUser;

class TempatPkl extends Model
{
    use HasFactory;

    protected $table = 'tempat_pkl';
    protected $primaryKey = 'tempat_pkl_id'; // 🔥 WAJIB
    public $incrementing = true;              // 🔥 TAMBAH
    protected $keyType = 'int';               // 🔥 TAMBAH
    public $timestamps = true;

    protected $fillable = [
        'nama_tempat',
        'alamat',
    ];

    public function siswa()
    {
        return $this->hasMany(MsUser::class, 'tempat_pkl_id', 'tempat_pkl_id')
            ->where('role', 'siswa');
    }
}
