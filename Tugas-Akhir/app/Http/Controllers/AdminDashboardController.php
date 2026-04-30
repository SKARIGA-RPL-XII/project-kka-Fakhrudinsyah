<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use App\Models\TempatPkl;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa      = MsUser::roleSiswa()->count();
        $jumlahPembimbing = MsUser::rolePembimbing()->count();
        $jumlahTempatPkl  = TempatPkl::count();

        // 🔥 GRAFIK: JUMLAH SISWA PER TEMPAT PKL
        $siswaPerTempat = DB::table('msuser')
            ->join('tempat_pkl', 'msuser.tempat_pkl_id', '=', 'tempat_pkl.tempat_pkl_id')
            ->select(
                'tempat_pkl.nama_tempat',
                DB::raw('COUNT(msuser.user_id) as total')
            )
            ->where('msuser.role', 'siswa')
            ->groupBy('tempat_pkl.nama_tempat')
            ->orderByDesc('total')
            ->get();

        // 🔥 GRAFIK: JUMLAH SISWA PER PEMBIMBING
        $siswaPerPembimbing = DB::table('msuser as siswa')
            ->join('msuser as pembimbing', 'siswa.pembimbing_id', '=', 'pembimbing.user_id')
            ->select(
                'pembimbing.nama as nama_pembimbing',
                DB::raw('COUNT(siswa.user_id) as total')
            )
            ->where('siswa.role', 'siswa')
            ->where('pembimbing.role', 'pembimbing')
            ->groupBy('pembimbing.nama')
            ->orderByDesc('total')
            ->get();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahPembimbing',
            'jumlahTempatPkl',
            'siswaPerTempat',
            'siswaPerPembimbing'
        ));
    }
}
