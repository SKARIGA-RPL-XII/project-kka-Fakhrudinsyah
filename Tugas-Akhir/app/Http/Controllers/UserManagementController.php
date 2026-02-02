<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use App\Models\TempatPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /* =====================================================
     * MANAJEMEN USER
     * ===================================================== */

    public function index(Request $request)
{
    $search = $request->search;

    $users = MsUser::query()
        ->when($search, function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
              ->orWhere('nis', 'like', "%{$search}%")
              ->orWhere('role', 'like', "%{$search}%");
        })
        ->orderBy('role')
        ->get();

    if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
        return view('manajemen_user.partials.table', compact('users'));
    }

    return view('manajemen_user.index', compact('users', 'search'));
}


    public function create()
    {
        $pembimbings = MsUser::rolePembimbing()->get();
        $tempatPkls  = TempatPkl::all();

        return view('manajemen_user.create', compact('pembimbings', 'tempatPkls'));
    }

    /* =======================
     * STORE USER
     * ======================= */
    public function store(Request $request)
    {
        $request->validate([
            'role'     => 'required|in:admin,pembimbing,siswa',
            'nama'     => 'required|string|max:100',
            'password' => 'required|min:6',

            'username' => 'nullable|required_if:role,admin,pembimbing|unique:msuser,username',
            'nis'      => 'nullable|required_if:role,siswa|unique:msuser,nis',
        ]);

        MsUser::create([
            'role'     => $request->role,
            'nama'     => $request->nama,
            'username' => in_array($request->role, ['admin', 'pembimbing'])
                            ? $request->username
                            : null,
            'nis'      => $request->role === 'siswa'
                            ? $request->nis
                            : null,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('manajemen_user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(MsUser $manajemen_user)
    {
        if ($manajemen_user->role === 'admin') {
            return redirect()
                ->route('manajemen_user.index')
                ->with('error', 'User admin tidak dapat diedit');
        }

        $pembimbings = MsUser::rolePembimbing()->get();
        $tempatPkls  = TempatPkl::all();

        return view('manajemen_user.edit', [
            'user'        => $manajemen_user,
            'pembimbings' => $pembimbings,
            'tempatPkls'  => $tempatPkls,
        ]);
    }

    /* =======================
     * UPDATE USER
     * ======================= */
    public function update(Request $request, MsUser $manajemen_user)
    {
        if ($manajemen_user->role === 'admin') {
            return redirect()
                ->route('manajemen_user.index')
                ->with('error', 'User admin tidak dapat diperbarui');
        }

        // ===== PEMBIMBING =====
        if ($manajemen_user->role === 'pembimbing') {
            $request->validate([
                'nama'     => 'required|string|max:100',
                'username' => 'required|unique:msuser,username,' . $manajemen_user->user_id . ',user_id',
                'password' => 'nullable|min:6',
            ]);

            $manajemen_user->nama     = $request->nama;
            $manajemen_user->username = $request->username;
        }

        // ===== SISWA =====
        if ($manajemen_user->role === 'siswa') {
            $request->validate([
                'nama' => 'required|string|max:100',
                'nis'  => 'required|unique:msuser,nis,' . $manajemen_user->user_id . ',user_id',
            ]);

            $manajemen_user->nama = $request->nama;
            $manajemen_user->nis  = $request->nis;

            $manajemen_user->pembimbing_id = null;
            $manajemen_user->tempat_pkl_id = null;
        }

        if ($request->filled('password')) {
            $manajemen_user->password = Hash::make($request->password);
        }

        $manajemen_user->save();

        return redirect()
            ->route('manajemen_user.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(MsUser $manajemen_user)
    {
        if ($manajemen_user->role === 'admin') {
            return redirect()
                ->route('manajemen_user.index')
                ->with('error', 'User admin tidak dapat dihapus');
        }

        $manajemen_user->delete();

        return redirect()
            ->route('manajemen_user.index')
            ->with('success', 'User berhasil dihapus');
    }
}
