<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */

   public function loginCheck(Request $request)
{
    $username = $request->post('username');
    $password = $request->post('password');

    if (!$username || !$password) {
        return response()->json([
            'status' => 'error',
            'message' => 'Username dan password wajib diisi'
        ]);
    }

    $user = DB::table('msuser')
        ->where('username', $username) // ⬅️ FIX UTAMA DI SINI
        ->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User tidak ditemukan'
        ]);
    }

    // // ⬅️ PASTIKAN password PLAIN TEXT
    // if (!Hash::check($password, $user->password)) {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Password salah'
    //     ]);
    // }

    Session::put('login', true);
    Session::put('user_id', $user->userid);
    Session::put('username', $user->username);
    Session::put('role', $user->role);

    return response()->json([
        'status' => 'success',
        'message' => 'Login berhasil'
    ]);
}
}
