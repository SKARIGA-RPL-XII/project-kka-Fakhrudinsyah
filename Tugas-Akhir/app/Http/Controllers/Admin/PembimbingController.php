<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    /**
     * TAMPIL DATA PEMBIMBING (VIEW)
     */
    public function index()
    {
        $pembimbings = MsUser::where('role', 'pembimbing')
            ->withCount('siswaBimbingan')
            ->orderBy('nama')
            ->get();

        return view('admin.pembimbing.index', compact('pembimbings'));
    }

    /**
     * 🔍 AJAX SEARCH PEMBIMBING (JSON ONLY)
     */
    public function search(Request $request)
    {
        $search = $request->search;

        $pembimbings = MsUser::where('role', 'pembimbing') // 🔥 KUNCI ROLE
            ->where('nama', 'like', "%{$search}%")
            ->withCount('siswaBimbingan')
            ->orderBy('nama')
            ->get(['id', 'nama']);

        return response()->json($pembimbings);
    }
}
