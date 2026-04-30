<?php

namespace App\Imports;

use App\Models\MsUser;
use App\Models\TempatPkl;
use App\Models\Pembimbing;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        unset($rows[0]); // hapus header

        foreach ($rows as $row) {

            // skip kalau kosong
            if (!$row[0] && !$row[1]) {
                continue;
            }

            $nis = $row[0];
            $nama = $row[1];
            $password = $row[2];
            $role = strtolower($row[3]);
            $namaTempat = $row[4];
            $namaPembimbing = $row[5];

            // 🔍 cari ID tempat PKL
            $tempat = TempatPkl::where('nama_tempat', $namaTempat)->first();

            // 🔍 cari ID pembimbing
            $pembimbing = Pembimbing::where('nama_pembimbing', $namaPembimbing)->first();

            MsUser::create([
                'nis' => $role === 'siswa' ? $nis : null,
                'nama' => $nama,
                'password' => Hash::make($password),
                'role' => $role,
                'tempat_pkl_id' => $tempat ? $tempat->tempat_pkl_id : null,
                'pembimbing_id' => $pembimbing ? $pembimbing->pembimbing_id : null,
            ]);
        }
    }
}

