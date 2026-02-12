<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pembimbingId = Auth::id();

        // Ambil siswa bimbingan
        $siswa = MsUser::with('tempatPkl')
            ->where('role', 'siswa')
            ->where('pembimbing_id', $pembimbingId)
            ->get();

        $totalSiswa = $siswa->count();

        $fileMasuk = Laporan::whereIn(
            'siswa_id',
            $siswa->pluck('user_id')
        )->count();

        $chatBaru = 0; // nanti bisa dikembangkan

        return view('pembimbing.dashboard', compact(
            'siswa',
            'totalSiswa',
            'fileMasuk',
            'chatBaru'
        ));
    }
}
