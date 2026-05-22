<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CutiController;
use App\Http\Controllers\PengajuanCutiController;

/*
|--------------------------------------------------------------------------
| DEFAULT ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (jika pakai Laravel Breeze / UI / custom auth)
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

/*
|--------------------------------------------------------------------------
| CUTI PEGAWAI (PENGAJUAN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Halaman pengajuan cuti (pegawai)
    Route::get('/cuti', [PengajuanCutiController::class, 'index'])
        ->name('cuti.index');

    // Submit pengajuan cuti
    Route::post('/cuti/store', [PengajuanCutiController::class, 'store'])
        ->name('cuti.store');

    /*
    |--------------------------------------------------------------------------
    | APPROVAL CUTI (PETINGGI / ADMIN)
    |--------------------------------------------------------------------------
    */

    // Halaman approval
    Route::get('/cuti/approval', [CutiController::class, 'approval'])
        ->name('cuti.approval');

    // Update status (AJAX)
    Route::post('/cuti/update-status/{id}', [CutiController::class, 'updateStatus'])
        ->name('cuti.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | REKAP CUTI
    |--------------------------------------------------------------------------
    */

    Route::get('/cuti/rekap', [CutiController::class, 'rekap'])
        ->name('cuti.rekap');
});