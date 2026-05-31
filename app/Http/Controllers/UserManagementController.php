<?php

namespace App\Http\Controllers;

use App\Models\UserManagement; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar user dan form tambah (Satu Halaman)
     */
    public function index()
    {
        // Mengambil data user terbaru untuk dioper ke tabel blade
        $users = UserManagement::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user (Opsional jika kedepannya dipisah)
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Menyimpan data user baru ke database (Disinkronkan dengan form Blade)
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan dari form (Hanya menyeleksi inputan yang ada di index.blade.php)
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'role'     => 'required|string', // Validasi string biasa agar fleksibel pasca migrasi baru
        ]);

        // 2. Simpan data ke database lewat Model UserManagement
        UserManagement::create([
            'name'       => $request->username, // Kolom name otomatis disamakan dengan username agar tidak null
            'username'   => $request->username,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => Hash::make('12345678'), // Otomatis disuntik password default (Aman & di-hash)
            'is_active'  => true,                   // Default akun aktif
            'unit_kerja' => null,                   // Di-set null dulu karena form tidak memintanya
        ]);

        // 3. Redirect kembali ke halaman manajemen user dengan alert sukses
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan! Password default: 12345678');
    }
}