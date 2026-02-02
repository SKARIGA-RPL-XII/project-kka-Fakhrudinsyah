<?php

namespace App\Http\Controllers;

use App\Models\TempatPkl;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $tempat = TempatPkl::withCount([
                'siswa as jumlah_siswa' => function ($query) {
                    $query->where('role', 'siswa');
                }
            ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_tempat', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_tempat')
            ->get();


        if ($request->ajax()) {
            return view(
                'admin.tempat_pkl.partials.table',
                compact('tempat')
            )->render();
        }

        return view(
            'admin.tempat_pkl.index',
            compact('tempat', 'search')
        );
    }

    /**
     * FORM TAMBAH
     */
    public function create()
    {
        return view('admin.tempat_pkl.create');
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'alamat'      => 'required|string|max:500',
        ]);

        TempatPkl::create([
            'nama_tempat' => $request->nama_tempat,
            'alamat'      => $request->alamat,
        ]);

        return redirect()
            ->route('tempat_pkl.index')
            ->with('success', 'Data Tempat PKL berhasil ditambahkan.');
    }

    /**
     * FORM EDIT
     */
    public function edit(TempatPkl $tempat_pkl)
    {
        return view(
            'admin.tempat_pkl.edit',
            compact('tempat_pkl')
        );
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, TempatPkl $tempat_pkl)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'alamat'      => 'required|string|max:500',
        ]);

        $tempat_pkl->update([
            'nama_tempat' => $request->nama_tempat,
            'alamat'      => $request->alamat,
        ]);

        return redirect()
            ->route('tempat_pkl.index')
            ->with('success', 'Data Tempat PKL berhasil diperbarui.');
    }

    /**
     * HAPUS DATA
     */
    public function destroy(TempatPkl $tempat_pkl)
    {
        $tempat_pkl->delete();

        return redirect()
            ->route('tempat_pkl.index')
            ->with('success', 'Data Tempat PKL berhasil dihapus.');
    }
}
