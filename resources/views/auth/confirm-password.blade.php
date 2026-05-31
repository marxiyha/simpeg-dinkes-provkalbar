@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">

<h1 class="text-3xl font-bold text-green-700 mb-6 text-center">

Konfirmasi Password

</h1>

<form method="POST" action="{{ route('password.confirm') }}">

@csrf

<input
type="password"
name="password"
placeholder="Masukkan Password"
class="w-full border-2 border-green-300 rounded-xl p-3 mb-6"
required>

<button
class="w-full bg-green-700 text-white p-3 rounded-xl font-bold">

Konfirmasi

</button>

</form>

</div>

</div>

@endsection