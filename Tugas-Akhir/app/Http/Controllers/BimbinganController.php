<?php

namespace App\Http\Controllers;

use App\Models\BimbinganMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
{
    /**
     * HALAMAN BIMBINGAN SISWA
     */
    public function index()
    {
        $siswa = Auth::user();

        $messages = BimbinganMessage::where('siswa_id', $siswa->user_id)
            ->orderBy('created_at', 'asc')
            ->get(); // hapus filter pembimbing_id agar pesan pembimbing juga muncul

        return view('siswa.bimbingan.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'nullable|string',
            'file'  => 'nullable|file|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('bimbingan', 'public');
        }

        BimbinganMessage::create([
            'siswa_id' => Auth::user()->user_id, // gunakan user_id bukan id
            'pengirim' => 'siswa',
            'pesan'    => $request->pesan,
            'file'     => $filePath,
        ]);

        return redirect()->back();
    }
}
