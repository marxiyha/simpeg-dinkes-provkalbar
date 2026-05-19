<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

/*
|--------------------------------------------------------------------------
| MAIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CutiController;

/*
|--------------------------------------------------------------------------
| REDIRECT AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function ()
{
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| HALAMAN GUEST
|--------------------------------------------------------------------------
| Halaman sebelum login
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function ()
{

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/login', function ()
    {
        return view('layouts.login');
    })->name('login');

    Route::post(
        '/login',
        [
            AuthenticatedSessionController::class,
            'store'
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('/register', function ()
    {
        return view('layouts.register');
    })->name('register');

    Route::post(
        '/register',
        [
            RegisteredUserController::class,
            'store'
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get('/forgot-password', function ()
    {
        return view('layouts.forgot-password');
    })->name('password.request');

    Route::post(
        '/forgot-password',
        [
            PasswordResetLinkController::class,
            'store'
        ]
    )->name('password.email');

});

/*
|--------------------------------------------------------------------------
| HALAMAN SETELAH LOGIN
|--------------------------------------------------------------------------
| Semua route wajib login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function ()
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function ()
    {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | CUTI
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | APPROVAL CUTI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/cuti/approval',
        [
            CutiController::class,
            'approval'
        ]
    )->name('cuti.approval');

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS CUTI AJAX
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/cuti/update-status/{id}',
        [
            CutiController::class,
            'updateStatus'
        ]
    )->name('cuti.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | REKAP CUTI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/cuti/rekap',
        [
            CutiController::class,
            'rekap'
        ]
    )->name('cuti.rekap');

    /*
    |--------------------------------------------------------------------------
    | DINAS LUAR
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | KALENDER DINAS LUAR
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dinasluar/kalender',
        function ()
        {
            return view('dinasluar.kalender');
        }
    )->name('dinasluar.kalender');

    /*
    |--------------------------------------------------------------------------
    | REKAP DINAS LUAR
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dinasluar/rekap',
        function ()
        {
            return view('dinasluar.rekap');
        }
    )->name('dinasluar.rekap');

    /*
    |--------------------------------------------------------------------------
    | PROFIL
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profil',
        function ()
        {
            return view('profil.index');
        }
    )->name('profil');

    /*
    |--------------------------------------------------------------------------
    | PENGATURAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pengaturan',
        function ()
        {
            return view('pengaturan.index');
        }
    )->name('pengaturan');

    /*
    |--------------------------------------------------------------------------
    | REKAPITULASI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/rekapitulasi',
        function ()
        {
            return view('rekapitulasi.index');
        }
    )->name('rekapitulasi');

    /*
    |--------------------------------------------------------------------------
    | PROFILE PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/profile/password',
        function ()
        {
            return back()->with(
                'success',
                'Password berhasil diubah'
            );
        }
    );

    /*
    |--------------------------------------------------------------------------
    | DELETE ACCOUNT
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/profile/delete',
        function ()
        {
            return redirect('/login');
        }
    );

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/logout',
        [
            AuthenticatedSessionController::class,
            'destroy'
        ]
    )->name('logout');

});