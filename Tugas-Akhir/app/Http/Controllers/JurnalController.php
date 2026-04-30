<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    /**
     * =========================
     * HALAMAN JURNAL SISWA
     * =========================
     */
    public function index()
    {
        $jurnals = Jurnal::where('siswa_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.jurnal.index', compact('jurnals'));
    }

    /**
     * =========================
     * SIMPAN JURNAL (MAX 1 / HARI)
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kegiatan' => 'required|string',
        ]);

        $sekarang = Carbon::now(); // ✅ ini sudah ada tanggal + jam

        // CEK SUDAH ISI HARI INI ATAU BELUM
        $sudahIsi = Jurnal::where('siswa_id', Auth::id())
            ->whereDate('tanggal', Carbon::today())
            ->exists();

        if ($sudahIsi) {
            return redirect()
                ->route('siswa.jurnal.history')
                ->with('error', 'Anda sudah mengisi jurnal hari ini.');
        }

        // SIMPAN (DATETIME)
        Jurnal::create([
            'siswa_id' => Auth::id(),
            'tanggal'  => $sekarang, // ✅ sekarang ada JAM
            'judul'    => $request->judul,
            'kegiatan' => $request->kegiatan,
            'status'   => 'menunggu',
        ]);

        return redirect()
            ->route('siswa.jurnal.history')
            ->with('success', 'Anda telah mengisi jurnal hari ini.');
    }

    /**
     * =========================
     * RIWAYAT JURNAL (7 HARI)
     * =========================
     */
    public function history()
    {
        $jurnals = Jurnal::where('siswa_id', Auth::id())
            ->whereDate('tanggal', '>=', Carbon::today()->subDays(7))
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.riwayat.index', compact('jurnals'));
    }

    /**
     * =========================
     * HALAMAN EDIT JURNAL
     * =========================
     */
    public function edit($id)
    {
        $jurnal = Jurnal::where('id', $id)
            ->where('siswa_id', Auth::id())
            ->firstOrFail();

        if ($jurnal->status !== 'menunggu') {
            return redirect()
                ->route('siswa.jurnal.history')
                ->with('error', 'Jurnal yang sudah diterima tidak dapat diedit.');
        }

        return view('siswa.riwayat.edit', compact('jurnal'));
    }

    /**
     * =========================
     * UPDATE JURNAL
     * =========================
     */
    public function update(Request $request, $id)
    {
        $jurnal = Jurnal::where('id', $id)
            ->where('siswa_id', Auth::id())
            ->firstOrFail();

        if ($jurnal->status !== 'menunggu') {
            return redirect()
                ->route('siswa.jurnal.history')
                ->with('error', 'Jurnal yang sudah diterima tidak dapat diedit.');
        }

        $request->validate([
            'judul'    => 'required|string|max:255',
            'kegiatan' => 'required|string',
        ]);

        $jurnal->update([
            'judul'    => $request->judul,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()
            ->route('siswa.jurnal.history')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }
}
