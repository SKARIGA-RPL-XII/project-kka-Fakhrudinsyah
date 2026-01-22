<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Halaman Login
Route::get('/', function () {
    return view('auth.login');
});

// Halaman Dashboard (setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Halaman Lainnya
Route::get('/jurnal', function () {
    return "<h1 class='p-8 text-center text-2xl'>Halaman Jurnal</h1>";
});

Route::get('/laporan', function () {
    return "<h1 class='p-8 text-center text-2xl'>Halaman Laporan</h1>";
});

Route::post('/login-check', [AuthController::class, 'loginCheck']);