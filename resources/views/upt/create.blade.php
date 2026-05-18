
@extends('layouts.app')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow-lg">

<h1 class="text-3xl font-bold text-green-700 mb-8">
Tambah Pegawai UPT
</h1>

<form class="space-y-5">

<input
type="text"
placeholder="NIP"
class="w-full border p-4 rounded-xl">

<input
type="text"
placeholder="Nama Pegawai"
class="w-full border p-4 rounded-xl">

<select class="w-full border p-4 rounded-xl">

<option>Laki-laki</option>
<option>Perempuan</option>

</select>

<input
type="text"
placeholder="Pendidikan"
class="w-full border p-4 rounded-xl">

<input
type="text"
placeholder="Jabatan"
class="w-full border p-4 rounded-xl">

<select name="upt_unit" class="w-full border p-2 mb-3">

    <option>UPT Klinik Utama Sungai Bangkong</option>
    <option>UPT Klinik Pratama</option>
    <option>UPT Laboratorium Kesehatan</option>
    <option>UPT Pelatihan Kesehatan</option>

</select>



<button
class="bg-green-700 text-white px-6 py-4 rounded-xl">
Simpan
</button>

</form>

</div>

@endsection
