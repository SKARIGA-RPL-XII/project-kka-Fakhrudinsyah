<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use App\Models\TempatPkl;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa      = MsUser::roleSiswa()->count();
        $jumlahPembimbing = MsUser::rolePembimbing()->count();
        $jumlahTempatPkl  = TempatPkl::count();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahPembimbing',
            'jumlahTempatPkl'
        ));
    }
}
