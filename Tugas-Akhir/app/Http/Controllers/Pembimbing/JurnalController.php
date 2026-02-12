<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    public function index()
{
    $pembimbingId = Auth::id();

    $jurnals = Jurnal::with('siswa')
        ->where('status', 'menunggu') // ⬅️ TAMBAHKAN INI
        ->whereHas('siswa', function ($q) use ($pembimbingId) {
            $q->where('pembimbing_id', $pembimbingId);
        })
        ->latest()
        ->get();

    return view('pembimbing.jurnal.index', compact('jurnals'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan_pembimbing' => 'nullable|string',
            'status' => 'required|in:menunggu,diterima'
        ]);

        $jurnal = Jurnal::findOrFail($id);

        $jurnal->update([
            'catatan_pembimbing' => $request->catatan_pembimbing,
            'status' => $request->status
        ]);

        return back()->with('success', 'Jurnal berhasil diperbarui.');
    }
}
