<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{UserManagement, PegawaiDinkes, PegawaiUPT, PengajuanCuti, KalenderDinasLuar};
use App\Exports\{ArrayExport, UPTMultiSheetExport};
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| ROOT & AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => Auth::check() ? redirect()->route('dashboard') : redirect()->route('login'));

// Auth Routes (via AuthController)
Route::get('/login', fn () => Auth::check() ? redirect('/dashboard') : view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/forgot-password', fn () => view('auth.forgot-password'))->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'updatePassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| OTP VERIFICATION
|--------------------------------------------------------------------------
*/
Route::get('/otp', [AuthController::class, 'otpForm'])->name('otp.form');
Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [AuthController::class, 'resendOtp'])->name('otp.resend');

/*
|--------------------------------------------------------------------------
| DASHBOARD & MAIN FEATURES (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard', [
        'dinkes' => PegawaiDinkes::count(), 
        'upt' => PegawaiUPT::count(), 
        'cuti' => PengajuanCuti::count(), 
        'kalender' => KalenderDinasLuar::count(), 
        'users' => UserManagement::count()
    ]))->name('dashboard');

    // Manajemen Pegawai & Data
    Route::get('/dinkes', fn(Request $request) => view('dinkes.index', [
        'dinkes' => PegawaiDinkes::when($request->search, fn($q) => $q->where('nama_pegawai', 'like', "%$request->search%"))->latest()->get()
    ]))->name('dinkes.index');

    Route::get('/upt', fn(Request $request) => view('upt.index', [
        'upt' => PegawaiUPT::when($request->upt_unit, fn($q) => $q->where('upt_unit', $request->upt_unit))->latest()->get()
    ]))->name('upt.index');

    Route::get('/cuti', function () {
        $data = PengajuanCuti::all()->map(fn($c) => [
            'nama' => $c->nama, 'jenis_cuti' => $c->jenis_cuti, 'tanggal_mulai' => $c->tanggal_mulai, 
            'tanggal_selesai' => $c->tanggal_selesai, 'status' => $c->status_pengajuan, 'alasan_cuti' => $c->alasan_cuti ?? '-'
        ]);
        return view('cuti.index', compact('data'));
    })->name('cuti.index');

    Route::get('/kalender', fn () => view('kalender.index', ['dinasLuar' => KalenderDinasLuar::all()]))->name('kalender.index');

    // User Management
    Route::get('/users', fn () => view('users.index', ['users' => UserManagement::latest()->get()]))->name('users.index');
    Route::post('/users/store', function (Request $request) {
        UserManagement::create(['name' => $request->username, 'username' => $request->username, 'email' => $request->email, 'password' => Hash::make($request->password), 'role' => $request->role]);
        return back()->with('success', 'User berhasil ditambahkan!');
    })->name('users.store');
    Route::put('/users/update/{id}', fn (Request $request, $id) => UserManagement::findOrFail($id)->update(['role' => $request->role]) ? back()->with('success', 'Role diupdate!') : back())->name('users.update');
    Route::delete('/users/delete/{id}', fn ($id) => UserManagement::findOrFail($id)->delete() ? back()->with('success', 'User dihapus!') : back())->name('users.destroy');

    /*
    |----------------------------------------------------------------------
    | EXPORT SYSTEM
    |----------------------------------------------------------------------
    */
    Route::get('/export', fn () => view('export.index'))->name('export');
    Route::get('/export/pegawai/excel', fn () => Excel::download(new ArrayExport(PegawaiDinkes::all()->toArray()), 'pegawai_dinkes.xlsx'));
    Route::get('/export/pegawai/pdf', fn () => Pdf::loadView('pdf.pegawai', ['data'=>PegawaiDinkes::all()])->download('pegawai_dinkes.pdf'));
    Route::get('/export/upt/excel', fn () => Excel::download(new UPTMultiSheetExport(), 'semua_upt.xlsx'));
    Route::get('/export/upt/pdf', fn () => Pdf::loadView('pdf.pegawai', ['data'=>PegawaiUPT::all()])->download('semua_upt.pdf'));
    Route::get('/export/cuti/excel', fn () => Excel::download(new ArrayExport(PengajuanCuti::all()->toArray()), 'laporan_cuti.xlsx'));
    Route::get('/export/cuti/pdf', fn () => Pdf::loadView('pdf.pegawai', ['data' => PengajuanCuti::all()])->download('laporan_cuti.pdf'));
    Route::get('/export/kalender/excel', fn () => Excel::download(new ArrayExport(KalenderDinasLinas::all()->toArray()), 'jadwal_dinas.xlsx'));
    Route::get('/export/kalender/pdf', fn () => Pdf::loadView('pdf.pegawai', ['data' => KalenderDinasLuar::all()])->download('jadwal_dinas.pdf'));

    /*
    |----------------------------------------------------------------------
    | PROFIL
    |----------------------------------------------------------------------
    */
    Route::get('/profil', fn () => view('profil.index'))->name('profil');
    Route::post('/profil/update', function (Request $request) {
        $request->validate(['password' => 'required|confirmed|min:6']);
        $user = Auth::user(); $user->password = Hash::make($request->password); $user->save();
        return back()->with('success', 'Password berhasil diubah.');
    })->name('profil.update');
    Route::delete('/profil/delete', function () {
        $user = Auth::user(); Auth::logout(); $user->delete(); return redirect('/login')->with('success', 'Akun dihapus.');
    })->name('profil.delete');
});

Route::fallback(fn () => Auth::check() ? redirect('/dashboard') : redirect('/login'));