<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\OtpLoginController;
use App\Http\Middleware\EnsureEmailOtpVerified;

Route::redirect('/', '/login')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // OTP Challenge routes (outside the EnsureEmailOtpVerified protection!)
    Route::inertia('/otp-challenge', 'auth/verify-otp')->name('otp.challenge');
    Route::post('/otp-verify', [OtpLoginController::class, 'verify2fa'])->name('otp.verify');

    // Fully protected routes (require both password auth AND email OTP)
    Route::middleware([EnsureEmailOtpVerified::class])->group(function () {
        // User
        Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::inertia('cuti', 'user/cuti')->name('cuti');
        Route::inertia('kalender', 'user/kalender')->name('kalender');
        Route::get('dinas-luar', [\App\Http\Controllers\DinasLuarController::class, 'index'])->name('dinasLuar');
        Route::post('dinas-luar', [\App\Http\Controllers\DinasLuarController::class, 'store'])->name('dinasLuar.store');
        
        // Pegawai CRUD (dipindah dari admin)
        Route::get('/pegawai', [\App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai.index');
        Route::post('/pegawai', [\App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
        Route::put('/pegawai/{pegawai}', [\App\Http\Controllers\PegawaiController::class, 'update'])->name('pegawai.update');
        Route::delete('/pegawai/{pegawai}', [\App\Http\Controllers\PegawaiController::class, 'destroy'])->name('pegawai.destroy');
        Route::get('/pegawai/export', [\App\Http\Controllers\PegawaiController::class, 'exportCsv'])->name('pegawai.export');
        Route::post('/pegawai/import', [\App\Http\Controllers\PegawaiController::class, 'importCsv'])->name('pegawai.import');
    });
});


require __DIR__.'/settings.php';
