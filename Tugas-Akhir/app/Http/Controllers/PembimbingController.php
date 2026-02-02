<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $pembimbing = MsUser::query()
            ->where('role', 'pembimbing') 
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama')
            ->get();

        return view('admin.pembimbing.index', compact('pembimbing', 'search'));
    }
}
