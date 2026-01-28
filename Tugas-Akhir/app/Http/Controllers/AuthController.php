<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function handleLogin(Request $request)
    {
        // ✅ VALIDASI LOGIN
        $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        // ✅ CARI USER DI TABEL msuser
        $user = MsUser::where('nis', $request->nis)->first();

        // ❌ Jika user tidak ada atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'nis' => 'NIS atau password salah',
            ])->withInput();
        }

        // ✅ LOGIN
        Auth::login($user);
        $request->session()->regenerate();

        // 🔀 REDIRECT BERDASARKAN ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pembimbing') {
            return redirect()->route('pembimbing.dashboard');
        }

        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        // fallback (jaga-jaga)
        Auth::logout();
        return redirect()->route('login')
            ->withErrors(['nis' => 'Role tidak dikenali']);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }
}
