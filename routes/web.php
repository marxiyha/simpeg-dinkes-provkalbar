<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\DinasKesehatanController;
use App\Http\Controllers\UptController;
use App\Http\Controllers\KalenderDinasLuarController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => Auth::check()
    ? redirect('/dashboard')
    : view('layouts.login')
)->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', fn () => view('layouts.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/forgot-password', fn () => view('layouts.forgot-password'))
    ->name('password.request');

Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('login')->with('success', 'Password berhasil diubah');
})->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| OTP
|--------------------------------------------------------------------------
*/
Route::get('/otp', [AuthController::class, 'otpForm'])->name('otp.form');
Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [AuthController::class, 'resendOtp'])->name('otp.resend');

/*
|--------------------------------------------------------------------------
| PROTECTED
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    | DASHBOARD
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | CUTI (WAJIB SESUAI ERROR KAMU)
    |--------------------------------------------------------------------------
    */
    Route::prefix('cuti')->name('cuti.')->group(function () {

        Route::get('/', [PengajuanCutiController::class, 'index'])->name('index');

        Route::get('/approval', [CutiController::class, 'approval'])->name('approval');

        Route::get('/rekap', [CutiController::class, 'rekap'])->name('rekap');

        Route::post('/store', [PengajuanCutiController::class, 'store'])->name('store');
    });

    /*
    |--------------------------------------------------------------------------
    | DINAS LUAR
    |--------------------------------------------------------------------------
    */
    Route::prefix('dinasluar')->name('dinasluar.')->group(function () {

        Route::get('/kalender', [KalenderDinasLuarController::class, 'index'])
            ->name('kalender');

        Route::get('/rekap', [KalenderDinasLuarController::class, 'rekapGlobal'])
            ->name('rekap');
    });

    /*
    |--------------------------------------------------------------------------
    | PETINGGI
    |--------------------------------------------------------------------------
    */
    Route::prefix('petinggi')->name('petinggi.')->group(function () {

        Route::get('/kalender-dinas-luar', [KalenderDinasLuarController::class, 'indexGlobal'])
            ->name('kalender');

        Route::get('/rekap-dinas-luar', [KalenderDinasLuarController::class, 'rekapGlobal'])
            ->name('rekap');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN USER
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | HAPUS AKUN
    |--------------------------------------------------------------------------
    */
    Route::delete('/hapus-akun', function (Request $request) {

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Akun dihapus');
    })->name('hapus.akun');
});

/*
|--------------------------------------------------------------------------
| FALLBACK
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return Auth::check()
        ? redirect('/dashboard')
        : redirect('/login');
});