<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib diimport untuk menangani auth()->user()

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
use App\Models\User; // Model User untuk otentikasi dan registrasi

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
    | LOGIN (FIXED BYPASS AGAR MANDAPATKAN AUTH USER)
    |--------------------------------------------------------------------------
    */

    Route::get('/login', function ()
    {
        return view('layouts.login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        // Ambil data user pertama dari database untuk dijadikan bypass login
        $user = User::first();

        // Jika database kamu kosong melompong, otomatis buatkan satu user petinggi dummy
        if (!$user) {
            $user = User::create([
                'name' => 'Petinggi Admin',
                'email' => 'petinggi@gmail.com',
                'username' => 'petinggi',
                'password' => bcrypt('password'),
                'role' => 'petinggi'
            ]);
        }

        // Login resmi ke sistem Laravel Auth agar {{ auth()->user()->name }} di dashboard terbaca!
        Auth::login($user);

        session([
            'login' => true,
            'user' => $user->name,
            'role' => 'petinggi'
        ]);

        return redirect('/dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('/register', function ()
    {
        return view('layouts.register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Otomatis isi kolom username jika kosong menggunakan kata depan email
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username ?? explode('@', $request->email)[0],
            'password' => bcrypt($request->password),
            'role' => 'petinggi'
        ]);

        // Login otomatis menggunakan Auth Laravel setelah registrasi berhasil
        Auth::login($user);

        session([
            'login' => true,
            'user' => $user->name,
            'role' => 'petinggi'
        ]);

        return redirect('/dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    });

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
| HALAMAN SETELAH LOGIN (SUDAH AMAN MENGGUNAKAN MIDDLEWARE AUTH)
|--------------------------------------------------------------------------
| Kembalikan route dashboard ke dalam middleware 'auth' karena login kita 
| sekarang sudah terdaftar resmi di Auth Laravel
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

    Route::post('/logout', function () {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    })->name('logout');

});