@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-green-100">

<div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-lg">

<h1 class="text-4xl font-bold text-center text-green-700 mb-4">

VERIFIKASI EMAIL

</h1>

<p class="text-center text-green-700 mb-8 leading-relaxed">

Terima kasih telah mendaftar di Sistem Super Admin Dinkes.
Sebelum melanjutkan, silakan verifikasi email Anda terlebih dahulu
melalui link yang telah dikirim ke email Anda.

</p>

@if (session('status') == 'verification-link-sent')

<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl mb-6">

Link verifikasi baru berhasil dikirim ke email Anda.

</div>

@endif

<div class="flex flex-col gap-4">

<form method="POST" action="{{ route('verification.send') }}">

@csrf

<button
type="submit"
class="w-full bg-green-700 hover:bg-green-800 text-white font-bold p-3 rounded-xl transition">

KIRIM ULANG EMAIL VERIFIKASI

</button>

</form>

<form method="POST" action="{{ route('logout') }}">

@csrf

<button
type="submit"
class="w-full bg-red-500 hover:bg-red-600 text-white font-bold p-3 rounded-xl transition">

LOGOUT

</button>

</form>

</div>

</div>

</div>

@endsection