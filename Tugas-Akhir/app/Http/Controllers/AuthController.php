<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * ======================
     * HALAMAN LOGIN
     * ======================
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * ======================
     * PROSES LOGIN
     * ======================
     */
    public function handleLogin(Request $request)
    {
        //  VALIDASI
        $request->validate([
            'login'    => 'required', // bisa username / nis
            'password' => 'required',
        ]);

        //  CARI USER (USERNAME ATAU NIS)
        $user = MsUser::where('username', $request->login)
            ->orWhere('nis', $request->login)
            ->first();

        //  USER TIDAK ADA / PASSWORD SALAH
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['login' => 'Username / NIS atau password salah'])
                ->withInput();
        }

        //  LOGIN
        Auth::login($user);
        $request->session()->regenerate();

        return match ($user->role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'pembimbing' => redirect()->route('pembimbing.dashboard'),
            'siswa'      => redirect()->route('siswa.dashboard'),
            default      => $this->logoutWithError($request),
        };
    }

    /**
     * ======================
     * LOGOUT
     * ======================
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }

    /**
     * fallback role tidak dikenal
     */
    private function logoutWithError(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('login')
            ->withErrors(['login' => 'Role tidak dikenali']);
    }
}
