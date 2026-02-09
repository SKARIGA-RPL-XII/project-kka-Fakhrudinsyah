<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use App\Models\TempatPkl;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    /**
     * =========================
     * HALAMAN DATA SISWA
     * =========================
     */
    public function index()
    {
        $siswa = MsUser::with(['pembimbingUser', 'tempatPkl'])
            ->roleSiswa()
            ->get();

        return view('admin.data_siswa.index', compact('siswa'));
    }

    /**
     * =========================
     * AJAX SEARCH (NAMA / NIS)
     * =========================
     */
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->keyword;

        $siswa = MsUser::with(['pembimbingUser', 'tempatPkl'])
            ->roleSiswa()
            ->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nis', 'like', "%{$keyword}%");
            })
            ->get();

        return view('admin.data_siswa.partials.table', compact('siswa'))->render();
    }

    /**
     * =========================
     * HALAMAN EDIT SISWA
     * =========================
     */
    public function edit($id)
    {
        $siswa = MsUser::with(['pembimbingUser', 'tempatPkl'])
            ->roleSiswa()
            ->findOrFail($id);

        $pembimbing = MsUser::where('role', 'pembimbing')->get();
        $tempatPkl  = TempatPkl::all();

        return view('admin.data_siswa.edit', compact(
            'siswa',
            'pembimbing',
            'tempatPkl'
        ));
    }

    /**
     * =========================
     * UPDATE PEMBIMBING & PKL
     * =========================
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pembimbing_id' => 'nullable|exists:msuser,user_id',
            'tempat_pkl_id' => 'nullable|exists:tempat_pkl,tempat_pkl_id',
        ]);

        $siswa = MsUser::roleSiswa()->findOrFail($id);

        $siswa->update([
            'pembimbing_id' => $request->pembimbing_id,
            'tempat_pkl_id' => $request->tempat_pkl_id,
        ]);

        return redirect()
            ->route('data_siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }
}
