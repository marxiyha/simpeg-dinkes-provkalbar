<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| MODELS
|--------------------------------------------------------------------------
*/

use App\Models\UserManagement;
use App\Models\PegawaiDinkes;
use App\Models\PegawaiUPT;
use App\Models\PengajuanCuti;
use App\Models\KalenderDinasLuar;

/*
|--------------------------------------------------------------------------
| EXPORT
|--------------------------------------------------------------------------
*/

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArrayExport;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| LOGIN (BYPASS LANGSUNG KE DASHBOARD DENGAN AUTH LARAVEL)
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => view('auth.login'));

Route::post('/login', function (Request $request) {
    // Ambil user pertama dari database untuk bypass login
    $user = UserManagement::first();

    // Jika belum ada user sama sekali di database, buatkan satu akun default
    if (!$user) {
        $user = UserManagement::create([
            'name' => 'Petinggi Admin',
            'username' => 'petinggi',
            'email' => 'petinggi@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'petinggi'
        ]);
    }

    // Login menggunakan sistem Auth bawaan Laravel agar session terikat sempurna
    Auth::login($user);

    session([
        'login' => true,
        'user' => $user->username,
        'role' => strtolower($user->role)
    ]);

    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', fn () => view('auth.register'));

Route::post('/register', function (Request $request) {

    $request->validate([
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed'
    ]);

    $user = UserManagement::create([
        'name' => $request->username,
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'pegawai'
    ]);

    Auth::login($user);

    session([
        'login' => true,
        'user' => $user->username,
        'role' => 'pegawai'
    ]);

    return redirect('/dashboard')->with('success', 'Register berhasil');
});

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', fn () => view('auth.forgot-password'));

Route::post('/forgot-password', function () {
    return redirect('/login')->with('success', 'Reset link dikirim (dummy)');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard', [
        'dinkes' => PegawaiDinkes::count(),
        'upt' => PegawaiUPT::count(),
        'cuti' => PengajuanCuti::count(),
        'kalender' => KalenderDinasLuar::count(),
        'users' => UserManagement::count(),
    ]);
});

/*
|--------------------------------------------------------------------------
| USERS MANAGEMENT (MENDUKUNG ROLE OPERATOR SETELAH ALTER ENUM)
|--------------------------------------------------------------------------
*/

Route::get('/users', fn () => view('users.index', [
    'users' => UserManagement::latest()->get()
]));

Route::post('/users', function (Request $request) {

    $request->validate([
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'role' => 'required'
    ]);

    // Mengubah input "Operator" menjadi "operator" agar sesuai dengan struktur ENUM database
    $cleanRole = strtolower($request->role);

    UserManagement::create([
        'name' => $request->username, 
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt('123456'), // Password default
        'role' => $cleanRole
    ]);

    return redirect('/users')->with('success', 'User berhasil ditambahkan dengan role ' . $request->role);
})->name('users.store');

Route::delete('/users/delete/{id}', function ($id) {

    $user = UserManagement::find($id);

    if ($user) {
        $user->delete();
    }

    return redirect('/users')->with('success', 'User berhasil dihapus');
});

/*
|--------------------------------------------------------------------------
| PROFIL
|--------------------------------------------------------------------------
*/

Route::get('/profil', fn () => view('profil.index'));

Route::post('/profil', function (Request $request) {

    $user = UserManagement::where('username', session('user'))->first();

    if (!$user) return back();

    if ($request->password) {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Password diupdate');
    }

    return back();
});

Route::delete('/profil', function () {

    $user = UserManagement::where('username', session('user'))->first();

    if ($user) $user->delete();

    Auth::logout();
    session()->flush();

    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| DATA MANAGEMENT (STORE, UPDATE, DELETE)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. DATA DINAS KESEHATAN
// ==========================================
Route::get('/dinkes', fn () => view('dinkes.index', [
    'dinkes' => PegawaiDinkes::latest()->get()
]));

Route::post('/data-dinkes/store', function (Request $request) {
    PegawaiDinkes::create($request->all());
    return redirect('/dinkes')->with('success', 'Data Pegawai Dinkes berhasil disimpan');
})->name('dinkes.store');

Route::put('/data-dinkes/update/{id}', function (Request $request, $id) {
    $pegawai = PegawaiDinkes::findOrFail($id);
    $pegawai->update($request->all());
    return redirect('/dinkes')->with('success', 'Data Pegawai Dinkes berhasil diperbarui');
})->name('dinkes.update');

Route::delete('/data-dinkes/delete/{id}', function ($id) {
    $pegawai = PegawaiDinkes::findOrFail($id);
    $pegawai->delete();
    return redirect('/dinkes')->with('success', 'Data Pegawai Dinkes berhasil dihapus');
})->name('dinkes.destroy');


// ==========================================
// 2. DATA 4 UPT
// ==========================================
Route::get('/upt', fn () => view('upt.index', [
    'upt' => PegawaiUPT::latest()->get()
]));

Route::post('/upt/store', function (Request $request) {
    PegawaiUPT::create($request->all());
    return redirect('/upt')->with('success', 'Data Pegawai UPT berhasil disimpan');
})->name('upt.store');

Route::put('/upt/update/{id}', function (Request $request, $id) {
    $upt = PegawaiUPT::findOrFail($id);
    $upt->update($request->all());
    return redirect('/upt')->with('success', 'Data Pegawai UPT berhasil diperbarui');
})->name('upt.update');

Route::delete('/upt/delete/{id}', function ($id) {
    $upt = PegawaiUPT::findOrFail($id);
    $upt->delete();
    return redirect('/upt')->with('success', 'Data Pegawai UPT berhasil dihapus');
})->name('upt.destroy');


// ==========================================
// 3. DATA CUTI
// ==========================================
Route::get('/cuti', fn () => view('cuti.index', [
    'cuti' => PengajuanCuti::latest()->get()
]));


// ==========================================
// 4. KALENDER DINAS LUAR
// ==========================================
Route::get('/kalender', fn () => view('kalender.index', [
    'events' => KalenderDinasLuar::latest()->get()
]));

Route::post('/kalender/store', function (Request $request) {
    $data = $request->all();
    
    if ($request->has('tanggal')) {
        $data['tanggal_dinas'] = $request->input('tanggal');
    }

    KalenderDinasLuar::create($data);
    return redirect('/kalender')->with('success', 'Agenda Dinas Luar berhasil disimpan');
})->name('kalender.store');

Route::put('/kalender/update/{id}', function (Request $request, $id) {
    $event = KalenderDinasLuar::findOrFail($id);
    $data = $request->all();

    if ($request->has('tanggal')) {
        $data['tanggal_dinas'] = $request->input('tanggal');
    }

    $event->update($data);
    return redirect('/kalender')->with('success', 'Agenda Dinas Luar berhasil diperbarui');
})->name('kalender.update');

Route::delete('/kalender/delete/{id}', function ($id) {
    $event = KalenderDinasLuar::findOrFail($id);
    $event->delete();
    return redirect('/kalender')->with('success', 'Agenda Dinas Luar berhasil dihapus');
})->name('kalender.destroy');


/*
|--------------------------------------------------------------------------
| REKAPITULASI
|--------------------------------------------------------------------------
*/

Route::get('/rekapitulasi', function () {

    $dinkes = PegawaiDinkes::all();
    $upt = PegawaiUPT::all();

    $data['Dinas Kesehatan'] = [
        'jabatan' => $dinkes->groupBy('jabatan')->map->count(),
        'gender' => $dinkes->groupBy('jenis_kelamin')->map->count(),
        'pendidikan' => $dinkes->groupBy('pendidikan')->map->count(),
        'status' => $dinkes->groupBy('status_pegawai')->map->count(),
    ];

    $units = [
        'UPT Klinik Utama Sungai Bangkong',
        'UPT Klinik Pratama',
        'UPT Laboratorium Kesehatan',
        'UPT Pelatihan Kesehatan'
    ];

    foreach ($units as $unit) {

        $items = $upt->where('upt_unit', $unit);

        $data[$unit] = [
            'jabatan' => $items->groupBy('jabatan')->map->count(),
            'gender' => $items->groupBy('jenis_kelamin')->map->count(),
            'pendidikan' => $items->groupBy('pendidikan')->map->count(),
            'status' => $items->groupBy('status_pegawai')->map->count(),
        ];
    }

    return view('rekap.index', compact('data'));
});

Route::get('/rekap', fn () => redirect('/rekapitulasi'));

/*
|--------------------------------------------------------------------------
| EXPORT SYSTEM
|--------------------------------------------------------------------------
*/

Route::get('/export', fn () => view('export.index'));

/* PEGAWAI EXPORT */
Route::get('/export/pegawai/excel', function () {
    return Excel::download(new ArrayExport(PegawaiDinkes::all()->toArray()), 'pegawai.xlsx');
});

Route::get('/export/pegawai/pdf', function () {

    $html = '<h2>DATA PEGAWAI</h2><table border="1" width="100%" cellpadding="8">
    <tr><th>Username</th><th>Email</th><th>Role</th></tr>';

    foreach (PegawaiDinkes::all() as $d) {
        $html .= "<tr><td>{$d->username}</td><td>{$d->email}</td><td>{$d->role}</td></tr>";
    }

    $html .= '</table>';

    return Pdf::loadHTML($html)->download('pegawai.pdf');
});

/* CUTI EXPORT */
Route::get('/export/cuti/excel', function () {
    return Excel::download(new ArrayExport(PengajuanCuti::all()->toArray()), 'cuti.xlsx');
});

Route::get('/export/cuti/pdf', function () {

    $html = '<h2>DATA CUTI</h2><table border="1" width="100%" cellpadding="8">
    <tr><th>Nama</th><th>Jenis</th><th>Status</th></tr>';

    foreach (PengajuanCuti::all() as $d) {
        $html .= "<tr><td>{$d->nama}</td><td>{$d->jenis_cuti}</td><td>{$d->status_pengajuan}</td></tr>";
    }

    $html .= '</table>';

    return Pdf::loadHTML($html)->download('cuti.pdf');
});

/* KALENDER EXPORT */
Route::get('/export/kalender/excel', function () {
    return Excel::download(new ArrayExport(KalenderDinasLuar::all()->toArray()), 'kalender.xlsx');
});

Route::get('/export/kalender/pdf', function () {

    $html = '<h2>KALENDER DINAS LUAR</h2><table border="1" width="100%" cellpadding="8">
    <tr><th>Nama</th><th>Tanggal</th><th>Lokasi</th></tr>';

    foreach (KalenderDinasLuar::all() as $d) {
        $html .= "<tr><td>{$d->nama_pegawai}</td><td>{$d->tanggal_dinas}</td><td>{$d->lokasi}</td></tr>";
    }

    $html .= '</table>';

    return Pdf::loadHTML($html)->download('kalender.pdf');
});

/* REKAP EXPORT */
Route::get('/export/rekap/excel', function () {

    $data = [
        ['kategori' => 'Dinkes', 'total' => PegawaiDinkes::count()],
        ['kategori' => 'UPT', 'total' => PegawaiUPT::count()],
        ['kategori' => 'Cuti', 'total' => PengajuanCuti::count()],
        ['kategori' => 'Kalender', 'total' => KalenderDinasLuar::count()],
    ];

    return Excel::download(new ArrayExport($data), 'rekap.xlsx');
});

Route::get('/export/rekap/pdf', function () {

    $html = '<h2>REKAP SISTEM</h2>
    <ul>
        <li>Dinkes: '.PegawaiDinkes::count().'</li>
        <li>UPT: '.PegawaiUPT::count().'</li>
        <li>Cuti: '.PengajuanCuti::count().'</li>
        <li>Kalender: '.KalenderDinasLuar::count().'</li>
    </ul>';

    return Pdf::loadHTML($html)->download('rekap.pdf');
});