<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Import Model
use App\Models\User;

// Import Controller 
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\DinasKesehatanController;
use App\Http\Controllers\UptController;
use App\Http\Controllers\KalenderDinasLuarController;
use App\Http\Controllers\UserController;

// OTP Controller dinonaktifkan sementara karena belum dibuat
// use App\Http\Controllers\OtpController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES - SIMPEG DINKES PROV KALBAR
|--------------------------------------------------------------------------
*/

/*
| 1. JALUR UTAMA & REDIRECT SYSTEM
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

/*
| 2. SISTEM LOGIN
*/
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('layouts.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $loginInput = $request->input('login') ?? $request->input('email') ?? $request->input('username');
    $passwordInput = $request->input('password');

    if (!$loginInput || !$passwordInput) {
        return back()->withErrors([
            'login' => 'Kolom Email/Username dan Password wajib diisi.',
        ])->withInput();
    }

    $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $field     => $loginInput,
        'password' => $passwordInput,
    ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'login' => 'Email / Username atau password tidak cocok dengan data kami.',
    ])->withInput();

})->name('login.post');

/*
| 3. SISTEM REGISTER
*/
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('layouts.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $generatedUsername = explode('@', $request->email)[0];

    $user = User::create([
        'name'     => $request->name,
        'username' => $generatedUsername, 
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'pegawai', 
    ]);

    Auth::login($user);
    return redirect('/dashboard');
})->name('register.post');

/*
| 4. RESET PASSWORD
*/
Route::get('/forgot-password', function () {
    return view('layouts.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Email tidak ditemukan.',
        ]);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect('/login')->with(
        'success',
        'Password berhasil diubah. Silakan login menggunakan password baru.'
    );
})->name('password.update');

/*
| 5. LOGOUT SYSTEM
*/
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| 6. JALUR PROTEKSI (MIDDLEWARE AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // === Halaman Dashboard Utama ===
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // === OTP DINONAKTIFKAN (Belum ada Controller & View) ===
    // Route::get('/otp-verification', [OtpController::class, 'showVerificationForm'])->name('otp.verification');
    // Route::post('/otp-verification', [OtpController::class, 'verify'])->name('otp.verify');

    // === Manajemen Profil internal Dashboard ===
    Route::delete('/hapus-akun', function (Request $request) {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Akun berhasil dihapus.');
    })->name('hapus.akun');

    Route::post('/ubah-password', function (Request $request) {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.']);
        }
        $user->password = Hash::make($request->password_baru);
        $user->save();
        return back()->with('success', 'Password berhasil diperbarui.');
    })->name('ubah.password');


    /*
    |----------------------------------------------------------------------
    | GRUP ROLE: PEGAWAI (USER)
    |----------------------------------------------------------------------
    */
    Route::get('/cuti', [PengajuanCutiController::class, 'index'])->name('cuti.index');
    Route::post('/cuti/store', [PengajuanCutiController::class, 'store'])->name('cuti.store');


    /*
    |----------------------------------------------------------------------
    | GRUP ROLE: OPERATOR
    |----------------------------------------------------------------------
    */
    Route::prefix('operator')->name('operator.')->group(function () {
        // Data Dinas Kesehatan
        Route::get('/dinas-kesehatan', [DinasKesehatanController::class, 'index'])->name('dinas.index');
        Route::post('/dinas-kesehatan/store', [DinasKesehatanController::class, 'store'])->name('dinas.store');
        Route::get('/dinas-kesehatan/edit/{id}', [DinasKesehatanController::class, 'edit'])->name('dinas.edit');
        Route::put('/dinas-kesehatan/update/{id}', [DinasKesehatanController::class, 'update'])->name('dinas.update');

        // Data 4 UPT
        Route::get('/upt', [UptController::class, 'index'])->name('upt.index');
        Route::post('/upt/store', [UptController::class, 'store'])->name('upt.store');
        Route::get('/upt/edit/{id}', [UptController::class, 'edit'])->name('upt.edit');
        Route::put('/upt/update/{id}', [UptController::class, 'update'])->name('upt.update');
    });


    /*
    |----------------------------------------------------------------------
    | GRUP ROLE: PETINGGI (Grup Utama dengan Prefiks)
    |----------------------------------------------------------------------
    */
    Route::prefix('petinggi')->name('petinggi.')->group(function () {
        // Persetujuan & Rekap Cuti
        Route::get('/cuti/approval', [CutiController::class, 'approval'])->name('cuti.approval');
        Route::post('/cuti/update-status/{id}', [CutiController::class, 'updateStatus'])->name('cuti.updateStatus');
        Route::get('/cuti/rekap', [CutiController::class, 'rekap'])->name('cuti.rekap'); 

        // Kalender & Rekap Dinas Luar (Global View)
        Route::get('/kalender-dinas-luar', [KalenderDinasLuarController::class, 'indexGlobal'])->name('kalender.index');
        Route::get('/rekap-dinas-luar', [KalenderDinasLuarController::class, 'rekapGlobal'])->name('rekap_dinas.index');
    });

    /*
    |----------------------------------------------------------------------
    | JALUR PENYELAMAT ALIAS (Agar rekap.blade.php / file lama tidak RouteNotFound)
    |----------------------------------------------------------------------
    */
    Route::get('/petinggi/cuti/approval-fallback', [CutiController::class, 'approval'])->name('cuti.approval');
    Route::get('/petinggi/cuti/rekap-fallback', [CutiController::class, 'rekap'])->name('cuti.rekap');


    /*
    |----------------------------------------------------------------------
    | GRUP ROLE: SUPER ADMIN / ADMIN
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        // Data Dinkes & Import-Export Excel
        Route::get('/dinas-kesehatan', [DinasKesehatanController::class, 'adminIndex'])->name('dinas.index');
        Route::put('/dinas-kesehatan/update/{id}', [DinasKesehatanController::class, 'adminUpdate'])->name('dinas.update');
        Route::post('/dinas-kesehatan/import', [DinasKesehatanController::class, 'importExcel'])->name('dinas.import');
        Route::get('/dinas-kesehatan/export', [DinasKesehatanController::class, 'exportExcel'])->name('dinas.export');

        // Data 4 UPT & Import-Export Excel
        Route::get('/upt', [UptController::class, 'adminIndex'])->name('upt.index');
        Route::put('/upt/update/{id}', [UptController::class, 'adminUpdate'])->name('adminUpdate'); // Mengamankan update admin
        Route::post('/upt/import', [UptController::class, 'importExcel'])->name('upt.import');
        Route::get('/upt/export', [UptController::class, 'exportExcel'])->name('upt.export');

        // Full CRUD Kalender Dinas Luar
        Route::get('/kalender-dinas-luar', [KalenderDinasLuarController::class, 'index'])->name('kalender.index');
        Route::post('/kalender-dinas-luar/store', [KalenderDinasLuarController::class, 'store'])->name('kalender.store');
        Route::get('/kalender-dinas-luar/edit/{id}', [KalenderDinasLuarController::class, 'edit'])->name('kalender.edit');
        Route::put('/kalender-dinas-luar/update/{id}', [KalenderDinasLuarController::class, 'update'])->name('kalender.update');
        Route::delete('/kalender-dinas-luar/delete/{id}', [KalenderDinasLuarController::class, 'destroy'])->name('kalender.delete');

        // Manajemen User Dropdown & Fix Operator Role Error
        Route::get('/manajemen-user', [UserController::class, 'index'])->name('users.index');
        Route::post('/manajemen-user/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/manajemen-user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/manajemen-user/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/manajemen-user/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

    // === Pembersih Session ===
    Route::get('/clear-session', function () {
        session()->forget('cuti_data');
        return redirect()->route('dashboard')->with('success', 'Session lama berhasil dibersihkan!');
    })->name('session.clear');

});

/*
| 7. FALLBACK ROUTE (Pencegah Error 404 Blank)
*/
Route::fallback(function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});