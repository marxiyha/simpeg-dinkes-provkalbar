<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => view('auth.login'));

Route::post('/login', function (Request $request) {

    session([
        'login' => true,
        'user' => $request->username
    ]);

    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| LOGOUT (FIXED - SUPPORT GET & POST)
|--------------------------------------------------------------------------
*/
Route::match(['get', 'post'], '/logout', function () {

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

    UserManagement::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'pegawai'
    ]);

    return redirect('/login')->with('success', 'Register berhasil');
});

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD (FIXED -> ALWAYS LOGIN AFTER SUBMIT)
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', fn () => view('auth.forgot-password'));

Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email'
    ]);

    return redirect('/login')
        ->with('success', 'Link reset password berhasil dikirim');
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
| PROFIL
|--------------------------------------------------------------------------
*/
Route::get('/profil', fn () => view('profil.index'));

Route::post('/profil', function (Request $request) {

    if ($request->has('password')) {

        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = UserManagement::where('username', session('user'))->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return back()->with('success', 'Password berhasil diupdate');
    }

    return back();
});

Route::delete('/profil', function () {

    $user = UserManagement::where('username', session('user'))->first();

    if ($user) {
        $user->delete();
    }

    session()->flush();

    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| USERS
|--------------------------------------------------------------------------
*/
Route::get('/users', function () {

    return view('users.index', [
        'users' => UserManagement::latest()->get()
    ]);
});

/*
|--------------------------------------------------------------------------
| DINKES
|--------------------------------------------------------------------------
*/
Route::get('/dinkes', fn () => view('dinkes.index', [
    'dinkes' => PegawaiDinkes::latest()->get()
]));

/*
|--------------------------------------------------------------------------
| UPT
|--------------------------------------------------------------------------
*/
Route::get('/upt', fn () => view('upt.index', [
    'upt' => PegawaiUPT::latest()->get()
]));

/*
|--------------------------------------------------------------------------
| CUTI
|--------------------------------------------------------------------------
*/
Route::get('/cuti', fn () => view('cuti.index', [
    'cuti' => PengajuanCuti::latest()->get()
]));

/*
|--------------------------------------------------------------------------
| KALENDER
|--------------------------------------------------------------------------
*/
Route::get('/kalender', fn () => view('kalender.index', [
    'events' => KalenderDinasLuar::latest()->get()
]));

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

/*
|--------------------------------------------------------------------------
| ALIAS REKAP
|--------------------------------------------------------------------------
*/
Route::get('/rekap', fn () => redirect('/rekapitulasi'));

/*
|--------------------------------------------------------------------------
| EXPORT
|--------------------------------------------------------------------------
*/
Route::get('/export', fn () => view('export.index'));

/*
|--------------------------------------------------------------------------
| EXPORT PEGAWAI
|--------------------------------------------------------------------------
*/
Route::get('/export/pegawai/excel', function () {
    return Excel::download(new ArrayExport(PegawaiDinkes::all()->toArray()), 'pegawai.xlsx');
});

Route::get('/export/pegawai/pdf', function () {

    $html = '<h2>DATA PEGAWAI</h2><table border="1" width="100%" cellpadding="8">
    <tr><th>Nama</th><th>Email</th><th>Role</th></tr>';

    foreach (PegawaiDinkes::all() as $d) {
        $html .= "<tr><td>{$d->username}</td><td>{$d->email}</td><td>{$d->role}</td></tr>";
    }

    $html .= '</table>';

    return Pdf::loadHTML($html)->download('pegawai.pdf');
});

/*
|--------------------------------------------------------------------------
| EXPORT CUTI
|--------------------------------------------------------------------------
*/
Route::get('/export/cuti/excel', function () {
    return Excel::download(new ArrayExport(PengajuanCuti::all()->toArray()), 'cuti.xlsx');
});

Route::get('/export/cuti/pdf', function () {

    $html = '<h2>DATA CUTI</h2><table border="1" width="100%" cellpadding="8">
    <tr><th>Nama</th><th>Jenis Cuti</th><th>Status</th></tr>';

    foreach (PengajuanCuti::all() as $d) {
        $html .= "<tr><td>{$d->nama}</td><td>{$d->jenis_cuti}</td><td>{$d->status_pengajuan}</td></tr>";
    }

    $html .= '</table>';

    return Pdf::loadHTML($html)->download('cuti.pdf');
});

/*
|--------------------------------------------------------------------------
| EXPORT KALENDER
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| EXPORT REKAP
|--------------------------------------------------------------------------
*/
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

    $html = '<h2>REKAP SISTEM</h2><ul>
    <li>Dinkes: '.PegawaiDinkes::count().'</li>
    <li>UPT: '.PegawaiUPT::count().'</li>
    <li>Cuti: '.PengajuanCuti::count().'</li>
    <li>Kalender: '.KalenderDinasLuar::count().'</li>
    </ul>';

    return Pdf::loadHTML($html)->download('rekap.pdf');
});