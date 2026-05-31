@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-green-700 mb-5">
    Data Dinas Kesehatan
</h1>

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
    {{ session('success') }}
</div>
@endif

{{-- ALERT ERROR --}}
@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
    {{ session('error') }}
</div>
@endif

{{-- ================= FORM TAMBAH ================= --}}
<div class="bg-white shadow rounded-2xl p-5 mb-6">

<h2 class="text-xl font-bold text-green-700 mb-4">
    Tambah Data Pegawai Dinkes
</h2>

<form method="POST" action="/data-dinkes/store"
      class="grid grid-cols-1 md:grid-cols-3 gap-3">
@csrf

<input type="text" name="nip" placeholder="NIP" class="border p-2 rounded" required>
<input type="text" name="nama_pegawai" placeholder="Nama Pegawai" class="border p-2 rounded" required>

<select name="jenis_kelamin" class="border p-2 rounded">
    <option value="">-- Jenis Kelamin --</option>
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
</select>

<input type="text" name="pendidikan" placeholder="Pendidikan" class="border p-2 rounded">
<input type="text" name="jabatan" placeholder="Jabatan" class="border p-2 rounded">
<input type="text" name="status_pegawai" placeholder="Status Pegawai" class="border p-2 rounded">

<input type="date" name="tmt_pensiun" class="border p-2 rounded">
<input type="text" name="batas_usia_pensiun" placeholder="BUP" class="border p-2 rounded">

<input type="email" name="email" placeholder="Email" class="border p-2 rounded">

<input type="date" name="prediksi_naik_gaji" class="border p-2 rounded">
<input type="date" name="prediksi_naik_pangkat" class="border p-2 rounded">

<select name="role" class="border p-2 rounded" required>
    <option value="">-- Pilih Role --</option>
    <option value="Pegawai">Pegawai</option>
    <option value="Petinggi">Petinggi</option>
    <option value="Admin">Admin</option>
    <option value="Operator">Operator</option>
</select>

<button class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-xl col-span-1 md:col-span-3">
    Simpan Data
</button>

</form>
</div>

{{-- ================= UPLOAD NORMAL ================= --}}
<div class="bg-white shadow rounded-2xl p-5 mb-6">

<h2 class="text-xl font-bold text-green-700 mb-4">
    Upload Excel / CSV (Normal)
</h2>

<form action="/data-dinkes/upload"
      method="POST"
      enctype="multipart/form-data"
      class="flex gap-3">
@csrf

<input type="file" name="file" class="border p-2 rounded w-full md:w-1/2" required>

<button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">
    Upload
</button>

</form>
</div>

{{-- ================= AUTO CLEAN ================= --}}
<div class="bg-white shadow rounded-2xl p-5 mb-6">

<h2 class="text-xl font-bold text-purple-700 mb-4">
    Auto Clean Import
</h2>

<form action="/data-dinkes/upload-clean"
      method="POST"
      enctype="multipart/form-data"
      class="flex gap-3">
@csrf

<input type="file" name="file" class="border p-2 rounded w-full md:w-1/2" required>

<button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl">
    Auto Clean Import
</button>

</form>
</div>

{{-- ================= TABLE ================= --}}
<div class="bg-white shadow rounded-2xl overflow-x-auto">

<table class="w-full text-sm">

<thead class="bg-green-700 text-white">
<tr>
<th class="p-3">NIP</th>
<th class="p-3">Nama</th>
<th class="p-3">JK</th>
<th class="p-3">Pendidikan</th>
<th class="p-3">Jabatan</th>
<th class="p-3">Status</th>
<th class="p-3">TMT</th>
<th class="p-3">BUP</th>
<th class="p-3">Gaji</th>
<th class="p-3">Pangkat</th>
<th class="p-3">Email</th>
<th class="p-3">Role</th>
<th class="p-3 text-center">Aksi</th>
</tr>
</thead>

<tbody>

@if(isset($dinkes) && count($dinkes) > 0)

@foreach($dinkes as $d)

<tr class="border-b hover:bg-green-50">

<td class="p-3">{{ $d->nip }}</td>
<td class="p-3">{{ $d->nama_pegawai }}</td>
<td class="p-3">{{ $d->jenis_kelamin }}</td>
<td class="p-3">{{ $d->pendidikan }}</td>
<td class="p-3">{{ $d->jabatan }}</td>
<td class="p-3">{{ $d->status_pegawai }}</td>
<td class="p-3">{{ $d->tmt_pensiun }}</td>
<td class="p-3">{{ $d->batas_usia_pensiun }}</td>
<td class="p-3">{{ $d->prediksi_naik_gaji }}</td>
<td class="p-3">{{ $d->prediksi_naik_pangkat }}</td>
<td class="p-3">{{ $d->email }}</td>

<td class="p-3">
    @if($d->role == 'Admin')
        <span class="bg-red-100 text-red-700 px-2 py-1 rounded">Admin</span>
    @elseif($d->role == 'Operator')
        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">Operator</span>
    @elseif($d->role == 'Petinggi')
        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Petinggi</span>
    @else
        <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Pegawai</span>
    @endif
</td>

<td class="p-3">
<div class="flex gap-2">

<a href="/data-dinkes/edit/{{ $d->id }}"
   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
   Edit
</a>

<form action="/data-dinkes/delete/{{ $d->id }}" method="POST">
@csrf
@method('DELETE')

<button onclick="return confirm('Hapus data?')"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
    Hapus
</button>

</form>

</div>
</td>

</tr>

@endforeach

@else

<tr>
<td colspan="13" class="text-center p-6 text-gray-500">
    Belum ada data Dinas Kesehatan
</td>
</tr>

@endif

</tbody>
</table>

</div>

@endsection