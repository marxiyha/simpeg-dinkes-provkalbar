<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{UserManagement, PegawaiDinkes, PegawaiUPT, PengajuanCuti, KalenderDinasLuar};
use App\Exports\{ArrayExport, UPTMultiSheetExport};
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| AUTH & DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect('/login'));
Route::get('/login', fn () => view('auth.login'));

Route::post('/login', function (Request $request) {
    $user = UserManagement::where('username', $request->username)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        session(['login' => true, 'user' => $user->username, 'role' => strtolower($user->role)]);
        return redirect('/dashboard');
    }
    return back()->withErrors(['msg' => 'Username atau password salah!']);
});

Route::match(['get', 'post'], '/logout', function () { 
    Auth::logout(); 
    session()->flush(); 
    return redirect('/login'); 
})->name('logout');

Route::get('/dashboard', fn() => view('dashboard', [
    'dinkes' => PegawaiDinkes::count(), 
    'upt' => PegawaiUPT::count(), 
    'cuti' => PengajuanCuti::count(), 
    'kalender' => KalenderDinasLuar::count(), 
    'users' => UserManagement::count()
]))->name('dashboard')->middleware('auth');

/*
|--------------------------------------------------------------------------
| MANAJEMEN PEGAWAI & DATA
|--------------------------------------------------------------------------
*/
Route::get('/dinkes', fn(Request $request) => view('dinkes.index', [
    'dinkes' => PegawaiDinkes::when($request->search, fn($q) => $q->where('nama_pegawai', 'like', "%$request->search%"))->latest()->get()
]))->name('dinkes.index')->middleware('auth');

Route::get('/upt', fn(Request $request) => view('upt.index', [
    'upt' => PegawaiUPT::when($request->upt_unit, fn($q) => $q->where('upt_unit', $request->upt_unit))->latest()->get()
]))->name('upt.index')->middleware('auth');

Route::get('/cuti', function () {
    $data = PengajuanCuti::all()->map(fn($c) => [
        'nama' => $c->nama, 
        'jenis_cuti' => $c->jenis_cuti, 
        'tanggal_mulai' => $c->tanggal_mulai, 
        'tanggal_selesai' => $c->tanggal_selesai, 
        'status' => $c->status_pengajuan, 
        'alasan_cuti' => $c->alasan_cuti ?? '-'
    ]);
    return view('cuti.index', compact('data'));
})->name('cuti.index')->middleware('auth');

Route::get('/kalender', fn () => view('kalender.index', [
    'dinasLuar' => KalenderDinasLuar::all()
]))->name('kalender.index')->middleware('auth');

/*
|--------------------------------------------------------------------------
| USER MANAGEMENT (CRUD)
|--------------------------------------------------------------------------
*/
Route::get('/users', fn () => view('users.index', ['users' => UserManagement::latest()->get()]))->name('users.index');

Route::post('/users/store', function (Request $request) {
    UserManagement::create([
        'name' => $request->username, 
        'username' => $request->username, 
        'email' => $request->email, 
        'password' => Hash::make($request->password), 
        'role' => $request->role
    ]);
    return back()->with('success', 'User berhasil ditambahkan!');
})->name('users.store');

Route::put('/users/update/{id}', fn (Request $request, $id) => 
    UserManagement::findOrFail($id)->update(['role' => $request->role]) ? back()->with('success', 'Role diupdate!') : back()
)->name('users.update');

Route::delete('/users/delete/{id}', fn ($id) => 
    UserManagement::findOrFail($id)->delete() ? back()->with('success', 'User dihapus!') : back()
)->name('users.destroy');

/*
|--------------------------------------------------------------------------
| EXPORT SYSTEM
|--------------------------------------------------------------------------
*/
Route::get('/export', fn () => view('export.index'))->name('export')->middleware('auth');

// Pegawai Dinkes
Route::get('/export/pegawai/excel', fn () => Excel::download(new ArrayExport(PegawaiDinkes::all()->toArray()), 'pegawai_dinkes.xlsx'));
Route::get('/export/pegawai/pdf', fn () => Pdf::loadView('pdf.pegawai', ['data'=>PegawaiDinkes::all()])->download('pegawai_dinkes.pdf'));

// UPT (Multi-Sheet)
Route::get('/export/upt/excel', fn () => Excel::download(new UPTMultiSheetExport(), 'semua_upt.xlsx'));
Route::get('/export/upt/pdf', fn () => Pdf::loadView('pdf.pegawai', ['data'=>PegawaiUPT::all()])->download('semua_upt.pdf'));

// Export Cuti (Lengkap dengan Rute PDF)
Route::get('/export/cuti/excel', fn () => Excel::download(new ArrayExport(PengajuanCuti::all()->toArray()), 'laporan_cuti.xlsx'));
Route::get('/export/cuti/pdf', function () {
    $pdf = Pdf::loadView('pdf.pegawai', ['data' => PengajuanCuti::all()]);
    return $pdf->download('laporan_cuti.pdf');
});

// Export Kalender (Lengkap dengan Rute PDF)
Route::get('/export/kalender/excel', fn () => Excel::download(new ArrayExport(KalenderDinasLuar::all()->toArray()), 'jadwal_dinas.xlsx'));
Route::get('/export/kalender/pdf', function () {
    $pdf = Pdf::loadView('pdf.pegawai', ['data' => KalenderDinasLuar::all()]);
    return $pdf->download('jadwal_dinas.pdf');
});

/*
|--------------------------------------------------------------------------
| PROFIL
|--------------------------------------------------------------------------
*/
Route::get('/profil', fn () => view('profil.index'))->name('profil');

Route::post('/profil/update', function (Request $request) {
    $request->validate(['password' => 'required|confirmed|min:6']);
    $user = Auth::user(); 
    $user->password = Hash::make($request->password); 
    $user->save();
    return back()->with('success', 'Password berhasil diubah.');
})->name('profil.update');

Route::delete('/profil/delete', function () {
    $user = Auth::user(); 
    Auth::logout(); 
    $user->delete(); 
    return redirect('/login')->with('success', 'Akun dihapus.');
})->name('profil.delete');