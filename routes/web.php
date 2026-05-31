<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

/*
|--------------------------------------------------------------------------
| REDIRECT AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| GUEST (LOGIN / REGISTER / FORGOT PASSWORD)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // LOGIN
    Route::get('/login', function () {
        return view('layouts.login');
    })->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // REGISTER
    Route::get('/register', function () {
        return view('layouts.register');
    })->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);

    // FORGOT PASSWORD
    Route::get('/forgot-password', function () {
        return view('layouts.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
});

/*
|--------------------------------------------------------------------------
| AUTH (SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CUTI
    Route::get('/cuti/approval', function () {
        return view('cuti.approval');
    })->name('cuti.approval');

    Route::get('/cuti/rekap', function () {
        return view('cuti.rekap');
    })->name('cuti.rekap');

    // DINAS LUAR
    Route::get('/dinasluar/kalender', function () {
        return view('dinasluar.kalender');
    })->name('dinasluar.kalender');

    Route::get('/dinasluar/rekap', function () {
        return view('dinasluar.rekap');
    })->name('dinasluar.rekap');

    // LOGOUT
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
