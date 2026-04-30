<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TempatPklController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AkunSiswaController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\Pembimbing\DashboardController;
use App\Http\Controllers\Pembimbing\BimbinganController as PembimbingBimbinganController;

/*
|--------------------------------------------------------------------------
| REDIRECT DEFAULT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN & LOGOUT)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handlelogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('siswa')->name('siswa.')->group(function () {

    // Dashboard Siswa
    Route::get('/dashboard', fn() => view('siswa.dashboard'))
        ->name('dashboard');

    // =======================
    // JURNAL SISWA
    // =======================

    // Halaman jurnal harian
    Route::get('/jurnal', [JurnalController::class, 'index'])
        ->name('jurnal.index');

    // Simpan jurnal
    Route::post('/jurnal', [JurnalController::class, 'store'])
        ->name('jurnal.store');

    // Riwayat jurnal (7 hari)
    Route::get('/jurnal/history', [JurnalController::class, 'history'])
        ->name('jurnal.history');


    // EDIT JURNAL (HANYA STATUS MENUNGGU)

    Route::get('/jurnal/{id}/edit', [JurnalController::class, 'edit'])
        ->name('jurnal.edit');

    Route::put('/jurnal/{id}', [JurnalController::class, 'update'])
        ->name('jurnal.update');

    // LAPORAN SISWA

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::post('/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');

    // Akun Siswa

    Route::get('/akun', [AkunSiswaController::class, 'index'])
        ->name('akun.index');

    // Bimbingan dengan Pembimbing

    Route::get('/bimbingan', [BimbinganController::class, 'index'])
        ->name('bimbingan.index');

    Route::post('/bimbingan', [BimbinganController::class, 'store'])
        ->name('bimbingan.store');
});

//EXPORTTTTTT IMPORTTTTTTTTTTTTTTT
Route::get('/admin/export-template-user', [UserManagementController::class, 'exportTemplate'])
    ->name('admin.user.export');

Route::post('/admin/import-user', [UserManagementController::class, 'import'])
    ->name('admin.user.import');






/*
|--------------------------------------------------------------------------
| PEMBIMBING
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('pembimbing')->name('pembimbing.')->group(function () {

    // Dashboard Pembimbing
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // =======================
    // BIMBINGAN PEMBIMBING
    // =======================
    Route::get('/bimbingan', [PembimbingBimbinganController::class, 'index'])
        ->name('bimbingan.index');

    Route::post(
        '/bimbingan/{siswa}',
        [\App\Http\Controllers\Pembimbing\BimbinganController::class, 'store']
    )->name('bimbingan.store');

    // Jurnal
    Route::get('/jurnal', [App\Http\Controllers\Pembimbing\JurnalController::class, 'index'])
        ->name('jurnal.index');

    Route::post('/jurnal/{id}/update', [App\Http\Controllers\Pembimbing\JurnalController::class, 'update'])
        ->name('jurnal.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    /*
    |----------------------------------------------------------------------
    | DASHBOARD ADMIN
    |----------------------------------------------------------------------
    */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | DATA PEMBIMBING
    |----------------------------------------------------------------------
    */
    Route::get('/pembimbing', [PembimbingController::class, 'index'])
        ->name('pembimbing.index');

    Route::get('/pembimbing/search', [PembimbingController::class, 'search'])
        ->name('pembimbing.search');

    /*
    |----------------------------------------------------------------------
    | DATA SISWA
    |----------------------------------------------------------------------
    */
    Route::get('/data-siswa', [DataSiswaController::class, 'index'])
        ->name('data_siswa.index');

    Route::get('/data-siswa/search', [DataSiswaController::class, 'ajaxSearch'])
        ->name('data_siswa.search');

    Route::get('/data-siswa/{id}/edit', [DataSiswaController::class, 'edit'])
        ->name('data_siswa.edit');

    Route::put('/data-siswa/{id}', [DataSiswaController::class, 'update'])
        ->name('data_siswa.update');

    /*
    |----------------------------------------------------------------------
    | MANAJEMEN USER
    |----------------------------------------------------------------------
    */
    Route::get('/manajemen-user/search', [UserManagementController::class, 'search'])
        ->name('manajemen_user.search');
    Route::resource('manajemen-user', UserManagementController::class)
        ->names('manajemen_user');
    /*
    |----------------------------------------------------------------------
    | TEMPAT PKL
    |----------------------------------------------------------------------
    */
    Route::resource('tempat_pkl', TempatPklController::class);
});
