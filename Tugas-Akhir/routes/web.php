<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TempatPklController;

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handlelogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/pembimbing/dashboard', fn () => view('pembimbing.dashboard'))
    ->name('pembimbing.dashboard');

Route::get('/siswa/dashboard', fn () => view('siswa.dashboard'))
    ->name('siswa.dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', fn () => view('admin.dashboard'))
        ->name('admin.dashboard');

    // 🔥 AJAX SEARCH (FIXED)
    Route::get(
        '/manajemen-user/ajax-search',
        [UserManagementController::class, 'ajaxSearch']
    )->name('manajemen_user.ajaxSearch');

    // RESOURCE
    Route::resource('manajemen-user', UserManagementController::class)
        ->names('manajemen_user');

    Route::resource('tempat_pkl', TempatPklController::class);
});
