<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\MsUser;
use App\Models\BimbinganMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    /**
     * HALAMAN BIMBINGAN PEMBIMBING (LIST SISWA + CHAT)
     */
    public function index(Request $request)
    {
        $pembimbingId = Auth::id();
        $siswaAktifId = $request->siswa_id;

        /**
         * ==============================
         * LIST SISWA BIMBINGAN + UNREAD
         * ==============================
         */
        $siswaList = MsUser::where('role', 'siswa')
            ->where('pembimbing_id', $pembimbingId)
            ->get()
            ->map(function ($siswa) {
                $siswa->unread_count = BimbinganMessage::where('siswa_id', $siswa->user_id)
                    ->whereNull('pembimbing_id') // pesan dari siswa
                    ->where('dibaca', 0)
                    ->count();

                return $siswa;
            });

        $messages = collect();
        $siswaAktif = null;

        /**
         * ==============================
         * JIKA SISWA DIPILIH
         * ==============================
         */
        if ($siswaAktifId) {
            $siswaAktif = MsUser::where('role', 'siswa')
                ->where('user_id', $siswaAktifId)
                ->where('pembimbing_id', $pembimbingId)
                ->firstOrFail();

            // ambil seluruh chat 2 arah
            $messages = BimbinganMessage::where('siswa_id', $siswaAktifId)
                ->orderBy('created_at')
                ->get();

            // tandai pesan siswa sebagai dibaca
            BimbinganMessage::where('siswa_id', $siswaAktifId)
                ->whereNull('pembimbing_id')
                ->where('dibaca', 0)
                ->update(['dibaca' => 1]);
        }

        return view('pembimbing.bimbingan.index', compact(
            'siswaList',
            'messages',
            'siswaAktif'
        ));
    }

    /**
     * ==============================
     * SIMPAN BALASAN PEMBIMBING
     * ==============================
     */
    public function store(Request $request, $siswaId)
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
    'siswa_id'      => $siswaId,
    'pembimbing_id' => Auth::id(),
    'pengirim'      => 'pembimbing',   // tambah ini
    'pesan'         => $request->pesan,
    'file'          => $filePath,
    'dibaca'        => 0,
]);

        return redirect()->back();
    }
}
