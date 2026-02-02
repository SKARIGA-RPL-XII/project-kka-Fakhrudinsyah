<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TempatPklController;
use App\Http\Controllers\Admin\PembimbingController;

/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/
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
| DASHBOARD PER ROLE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/pembimbing/dashboard', fn () => view('pembimbing.dashboard'))
        ->name('pembimbing.dashboard');

    Route::get('/siswa/dashboard', fn () => view('siswa.dashboard'))
        ->name('siswa.dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', fn () => view('admin.dashboard'))
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | DATA PEMBIMBING (VIEW ONLY + AJAX SEARCH)
    |--------------------------------------------------------------------------
    */
    Route::get('/pembimbing', [PembimbingController::class, 'index'])
        ->name('pembimbing.index');

    Route::get('/pembimbing/search', [PembimbingController::class, 'search'])
        ->name('pembimbing.search');

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN USER
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'manajemen-user',
        UserManagementController::class
    )->names('manajemen_user');

    /*
    |--------------------------------------------------------------------------
    | TEMPAT PKL
    |--------------------------------------------------------------------------
    */
    

    // CRUD TEMPAT PKL
    Route::resource('tempat_pkl', TempatPklController::class);
});
