<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use App\Models\TempatPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * TAMPIL DATA (HALAMAN UTAMA)
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $users = MsUser::with(['tempatPkl', 'pembimbing'])
            ->when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->get();

        // Jika request AJAX, return partial table
        if ($request->ajax()) {
            return view('manajemen_user.partials.table', compact('users'));
        }

        return view('manajemen_user.index', compact('users', 'search'));
    }

    /**
     * FORM TAMBAH USER
     */
    public function create()
    {
        $tempatPkl  = TempatPkl::all();
        $pembimbing = MsUser::where('role', 'pembimbing')->get();

        return view('manajemen_user.create', compact('tempatPkl', 'pembimbing'));
    }

    /**
     * SIMPAN USER
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string',
            'nis'            => 'required|digits_between:1,10|unique:msuser,nis',
            'password'       => 'required|min:6',
            'role'           => 'required|in:admin,pembimbing,siswa',
            'tempat_pkl_id'  => 'nullable|required_if:role,siswa|exists:tempat_pkl,tempat_pkl_id',
            'pembimbing_id'  => 'nullable|required_if:role,siswa|exists:msuser,user_id',
        ]);

        MsUser::create([
            'nama'           => $request->nama,
            'nis'            => $request->nis,
            'password'       => Hash::make($request->password),
            'role'           => $request->role,
            'tempat_pkl_id'  => $request->role === 'siswa' ? $request->tempat_pkl_id : null,
            'pembimbing_id'  => $request->role === 'siswa' ? $request->pembimbing_id : null,
        ]);

        return redirect()->route('manajemen_user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * FORM EDIT USER
     */
    public function edit(MsUser $manajemen_user)
    {
        // Cegah edit akun admin
        if ($manajemen_user->role === 'admin') {
            return redirect()->route('manajemen_user.index')
                ->with('error', 'Akun admin tidak bisa diedit.');
        }

        $tempatPkl  = TempatPkl::all();
        $pembimbing = MsUser::where('role', 'pembimbing')->get();

        return view('manajemen_user.edit', [
            'user'       => $manajemen_user,
            'tempatPkl'  => $tempatPkl,
            'pembimbing' => $pembimbing
        ]);
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, MsUser $manajemen_user)
    {
        // Cegah update akun admin
        if ($manajemen_user->role === 'admin') {
            return redirect()->route('manajemen_user.index')
                ->with('error', 'Akun admin tidak bisa diperbarui.');
        }

        $request->validate([
            'nama'           => 'required|string',
            'role'           => 'required|in:admin,pembimbing,siswa',
            'tempat_pkl_id'  => 'nullable|required_if:role,siswa|exists:tempat_pkl,tempat_pkl_id',
            'pembimbing_id'  => 'nullable|required_if:role,siswa|exists:msuser,user_id',
        ]);

        $manajemen_user->update([
            'nama'           => $request->nama,
            'role'           => $request->role,
            'tempat_pkl_id'  => $request->role === 'siswa' ? $request->tempat_pkl_id : null,
            'pembimbing_id'  => $request->role === 'siswa' ? $request->pembimbing_id : null,
        ]);

        return redirect()->route('manajemen_user.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * HAPUS USER
     */
    public function destroy(MsUser $manajemen_user)
    {
        // Cegah hapus akun admin
        if ($manajemen_user->role === 'admin') {
            return back()->with('error', 'Akun admin tidak bisa dihapus.');
        }

        $manajemen_user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
