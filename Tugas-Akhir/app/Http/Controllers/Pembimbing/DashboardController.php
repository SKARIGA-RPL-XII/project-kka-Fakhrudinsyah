<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Ambil ID siswa
        $siswaIds = $siswa->pluck('user_id');

        // Total laporan masuk
        $fileMasuk = Laporan::whereIn('siswa_id', $siswaIds)->count();

        $chatBaru = 0;

        // 🔥 GRAFIK JURNAL PER BULAN
        $jurnalPerBulan = DB::table('jurnal')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('siswa_id', $siswaIds)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('bulan', 'asc')
            ->get();

        // 🔥 GRAFIK LAPORAN PER BULAN
        $laporanPerBulan = DB::table('laporan')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('siswa_id', $siswaIds)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('bulan', 'asc')
            ->get();

        // 🔥 GRAFIK TEMPAT PKL
        $tempatPklChart = DB::table('msuser')
            ->join('tempat_pkl', 'msuser.tempat_pkl_id', '=', 'tempat_pkl.tempat_pkl_id')
            ->select(
                'tempat_pkl.nama_tempat as nama_tempat',
                DB::raw('COUNT(msuser.user_id) as total')
            )
            ->where('msuser.role', 'siswa')
            ->where('msuser.pembimbing_id', $pembimbingId)
            ->groupBy('tempat_pkl.nama_tempat')
            ->orderByDesc('total')
            ->get();

        return view('pembimbing.dashboard', compact(
            'siswa',
            'totalSiswa',
            'fileMasuk',
            'chatBaru',
            'jurnalPerBulan',
            'laporanPerBulan',
            'tempatPklChart' // ✅ WAJIB ADA
        ));
    }
}
