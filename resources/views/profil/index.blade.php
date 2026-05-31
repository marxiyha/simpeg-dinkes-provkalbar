@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <!-- TITLE -->
    <h2 class="text-2xl font-bold text-green-700 mb-6">
        Edit Profil
    </h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- INFO USER -->
    <div class="mb-6">
        <p class="font-semibold">Nama</p>
        <p class="text-gray-700">
            {{ session('user') ?? 'User tidak ditemukan' }}
        </p>
    </div>

    <div class="mb-6">
        <p class="font-semibold">Email</p>
        <p class="text-gray-700">
            admin@dinkes.go.id
        </p>
    </div>

    <hr class="my-6">

    <!-- GANTI PASSWORD -->
    <h3 class="font-bold mb-3 text-green-700">
        Ganti Password
    </h3>

    <form method="POST" action="{{ url('/profil') }}">
        @csrf

        <input type="password"
               name="password"
               class="w-full border p-3 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-green-500"
               placeholder="Password Baru"
               required>

        <input type="password"
               name="password_confirmation"
               class="w-full border p-3 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-green-500"
               placeholder="Konfirmasi Password"
               required>

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded">
            Simpan
        </button>
    </form>

    <hr class="my-6">

    <!-- HAPUS AKUN -->
    <h3 class="font-bold mb-3 text-red-600">
        Danger Zone
    </h3>

    <p class="text-sm text-gray-500 mb-4">
        Tindakan ini akan menghapus akun secara permanen dan logout otomatis.
    </p>

    <form method="POST" action="{{ url('/profil') }}"
          onsubmit="return confirm('Yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan!')">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">
            Hapus Akun
        </button>

    </form>

</div>

@endsection