@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold text-green-700 mb-6">
        Edit Profil
    </h2>

    <!-- INFO USER -->
    <div class="mb-6">
        <p class="font-semibold">Nama</p>
        <p class="text-gray-700">{{ session('nama') }}</p>
    </div>

    <div class="mb-6">
        <p class="font-semibold">Email</p>
        <p class="text-gray-700">admin@dinkes.go.id</p>
    </div>

    <hr class="my-6">

    <!-- FORM PASSWORD -->
    <h3 class="font-bold mb-3">Ganti Password</h3>

    <form method="POST" action="#">
        @csrf

        <input type="password"
               class="w-full border p-2 rounded mb-3"
               placeholder="Password Baru">

        <input type="password"
               class="w-full border p-2 rounded mb-4"
               placeholder="Konfirmasi Password">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>

    <hr class="my-6">

    <!-- HAPUS AKUN -->
    <h3 class="font-bold mb-3 text-red-600">Danger Zone</h3>

    <form method="POST" action="#">
        @csrf
        @method('DELETE')

        <button class="bg-red-600 text-white px-4 py-2 rounded">
            Hapus Akun
        </button>
    </form>

</div>

@endsection