<?php

use App\Http\Controllers\Admin\UserController as ReactUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DinasLuarController;
use App\Http\Controllers\KalenderDinasLuarController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| ROOT & AUTHENTICATION
|--------------------------------------------------------------------------
*/
// Redirect root ke login atau dashboard
Route::get('/', fn () => Auth::check() ? redirect()->route('dashboard') : redirect()->route('login'));

// Alias 'home' → dashboard (dibutuhkan oleh Fortify & beberapa internal redirect)
Route::get('/home', fn () => redirect()->route('dashboard'))->name('home');

// Login Portals
Route::get('/login/petinggi', fn () => Auth::check()
    ? redirect('/dashboard')
    : view('layouts.login'))->name('login.petinggi');
Route::post('/login/petinggi', [AuthController::class, 'loginPetinggi'])->name('login.petinggi.post');

Route::get('/login/pegawai', fn () => Auth::check()
    ? redirect('/dashboard')
    : Inertia::render('auth/login', [
        'canResetPassword' => true,
        'canRegister' => false,
        'status' => session('status'),
    ]))->name('login');
Route::post('/login/pegawai', [AuthController::class, 'loginPegawai'])->name('login.pegawai.store');

Route::get('/login', fn () => redirect()->route('login'))->name('login.redirect');

// Register (React)
Route::get('/register', fn () => Auth::check()
    ? redirect('/dashboard')
    : Inertia::render('auth/register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Forgot Password (React)
Route::get('/forgot-password', fn () => Auth::check()
    ? redirect('/dashboard')
    : Inertia::render('auth/forgot-password', [
        'status' => session('status'),
    ]))->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'updatePassword'])->name('password.email');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| OTP VERIFICATION (Unified backend, conditional frontend)
|--------------------------------------------------------------------------
*/
Route::get('/otp', [AuthController::class, 'otpForm'])->name('otp.form');
Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp-verify', [AuthController::class, 'verifyOtp'])->name('otp.verify-direct'); // React Support
Route::post('/otp/resend', [AuthController::class, 'resendOtp'])->name('otp.resend');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Hanya bisa diakses jika login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CUTI (Conditional View: Blade vs React)
    Route::get('/cuti', function (Request $request) {
        $user = $request->user();
        if (in_array($user->role, ['superadmin', 'petinggi'])) {
            return app(PengajuanCutiController::class)->index();
        }

        $riwayatCuti = \App\Models\Cuti::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'jenis_cuti' => $item->jenis_cuti,
                    'tanggal_mulai' => $item->tanggal_mulai,
                    'tanggal_selesai' => $item->tanggal_selesai,
                    'alasan' => $item->alasan,
                    'status' => $item->status === 'Pending' ? 'Menunggu' : $item->status,
                ];
            });

        return Inertia::render('user/cuti', [
            'auth' => [
                'user' => $user,
            ],
            'riwayatCuti' => $riwayatCuti,
        ]);
    })->name('cuti');

    Route::prefix('cuti')->name('cuti.')->group(function () {
        Route::get('/approval', [CutiController::class, 'approval'])->name('approval');
        Route::get('/rekap', [CutiController::class, 'rekap'])->name('rekap');
        Route::post('/store', [PengajuanCutiController::class, 'store'])->name('store');
        Route::post('/update/{id}', [CutiController::class, 'updateStatusHtml'])->name('update');
        Route::delete('/delete/{id}', [CutiController::class, 'deleteCuti'])->name('delete');
    });

    // DINAS LUAR (Blade)
    Route::prefix('dinasluar')->name('dinasluar.')->group(function () {
        Route::get('/kalender', [KalenderDinasLuarController::class, 'index'])->name('kalender');
        Route::get('/rekap', [KalenderDinasLuarController::class, 'rekapGlobal'])->name('rekap');
    });

    // PETINGGI (Blade)
    Route::prefix('petinggi')->name('petinggi.')->group(function () {
        Route::get('/kalender-dinas-luar', [KalenderDinasLuarController::class, 'indexGlobal'])->name('kalender');
        Route::get('/rekap-dinas-luar', [KalenderDinasLuarController::class, 'rekapGlobal'])->name('rekap');
    });

    // BLADE USER MANAGEMENT (Superadmin)
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserManagementController::class, 'store'])->name('users.store');
    Route::delete('/users/delete/{id}', [UserManagementController::class, 'destroy'])->name('users.delete');

    // REACT ADMIN USER MANAGEMENT (Admin/Operator)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [ReactUserController::class, 'index'])->name('users.index');
        Route::post('/users/store', [ReactUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [ReactUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [ReactUserController::class, 'destroy'])->name('users.delete');
    });

    // REACT PEGAWAI CRUD
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    Route::get('/pegawai/export', [PegawaiController::class, 'exportCsv'])->name('pegawai.export');
    Route::post('/pegawai/import', [PegawaiController::class, 'importCsv'])->name('pegawai.import');

    // REACT KALENDER & DINAS LUAR
    Route::get('/kalender', fn () => Inertia::render('user/kalender'))->name('kalender');
    Route::get('/dinas-luar', [DinasLuarController::class, 'index'])->name('dinasLuar');
    Route::post('/dinas-luar', [DinasLuarController::class, 'store'])->name('dinasLuar.store');

    // HAPUS AKUN
    Route::delete('/hapus-akun', function (Request $request) {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus');
    })->name('hapus.akun');
});

require __DIR__.'/settings.php';

/*
|--------------------------------------------------------------------------
| FALLBACK
|--------------------------------------------------------------------------
|
*/
Route::fallback(fn () => Auth::check() ? redirect('/dashboard') : redirect('/login'));
