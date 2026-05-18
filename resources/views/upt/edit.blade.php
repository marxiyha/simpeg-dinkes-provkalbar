
@extends('layouts.app')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow-lg">

<h1 class="text-3xl font-bold text-green-700 mb-8">
Edit Pegawai UPT
</h1>

<form class="space-y-5">

<input
type="text"
value="1987654321"
class="w-full border p-4 rounded-xl">

<input
type="text"
value="Maria Grace"
class="w-full border p-4 rounded-xl">

<select class="w-full border p-4 rounded-xl">

<option>Perempuan</option>

</select>

<input
type="text"
value="S1"
class="w-full border p-4 rounded-xl">

<input
type="text"
value="Operator"
class="w-full border p-4 rounded-xl">

<select class="w-full border p-4 rounded-xl">

<option>UPT Klinik Pratama</option>

</select>

<button
class="bg-green-700 text-white px-6 py-4 rounded-xl">
Update
</button>

</form>

</div>

@endsection
