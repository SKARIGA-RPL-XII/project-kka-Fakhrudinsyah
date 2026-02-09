<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * HALAMAN LAPORAN SISWA
     */
    public function index()
    {
        $laporan = Laporan::where('siswa_id', Auth::id())->first();

        return view('siswa.laporan.index', compact('laporan'));
    }

    /**
     * SIMPAN LAPORAN (HANYA 1 KALI)
     */
    public function store(Request $request)
    {
        // CEK SUDAH UPLOAD ATAU BELUM
        $sudahUpload = Laporan::where('siswa_id', Auth::id())->exists();

        if ($sudahUpload) {
            return redirect()
                ->back()
                ->with('error', 'Anda sudah mengumpulkan laporan dan tidak dapat mengunggah ulang.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'file'  => 'required|mimes:ppt,pptx|max:5120', // max 5MB
        ]);

        $filePath = $request->file('file')
            ->store('laporan', 'public');

        Laporan::create([
            'siswa_id' => Auth::id(),
            'judul'    => $request->judul,
            'file'     => $filePath,
            'status'   => 'menunggu',
        ]);

        return redirect()
            ->route('siswa.laporan.index')
            ->with('success', 'Laporan berhasil dikumpulkan dan menunggu persetujuan.');
    }
}
