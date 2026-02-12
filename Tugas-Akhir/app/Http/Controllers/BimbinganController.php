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
            ->where('pembimbing_id', $siswa->pembimbing_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('siswa.bimbingan.index', compact('messages'));
    }

    /**
     * KIRIM PESAN / FILE
     */
    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'nullable|string',
            'file'  => 'nullable|file|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')
                ->store('bimbingan', 'public');
        }

        BimbinganMessage::create([
            'siswa_id'      => Auth::id(),
            'pembimbing_id' => Auth::user()->pembimbing_id,
            'pesan'         => $request->pesan,
            'file'          => $filePath,
        ]);

        return redirect()->back();
    }
}
