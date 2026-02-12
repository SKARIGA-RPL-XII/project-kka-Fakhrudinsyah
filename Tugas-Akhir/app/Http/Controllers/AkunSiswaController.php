<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Laporan;
use App\Models\MsUser;
use Illuminate\Support\Facades\Auth;

class AkunSiswaController extends Controller
{
    public function index()
    {
        $siswa = MsUser::with([
            'tempatPkl',
            'pembimbing'
        ])->find(Auth::id());

        // Jurnal terakhir
        $jurnalTerakhir = Jurnal::where('siswa_id', $siswa->user_id)
            ->orderBy('tanggal', 'desc')
            ->first();

        // Status laporan
        $laporan = Laporan::where('siswa_id', $siswa->user_id)->first();

        return view('siswa.akun.index', compact(
            'siswa',
            'jurnalTerakhir',
            'laporan'
        ));
    }
}
