@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-green-700 mb-5">
    Data UPT
</h1>

{{-- ===================== --}}
{{-- ALERT --}}
{{-- ===================== --}}
@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
    {{ session('error') }}
</div>
@endif

{{-- ===================== --}}
{{-- FILTER UPT --}}
{{-- ===================== --}}
<form method="GET" action="/upt" class="mb-5">

    <label class="font-bold text-green-700">Pilih UPT:</label>

    <select name="upt_unit"
            onchange="this.form.submit()"
            class="border p-2 rounded ml-2">

        <option value="">-- Semua UPT --</option>

        <option value="UPT Klinik Utama Sungai Bangkong"
            {{ request('upt_unit') == 'UPT Klinik Utama Sungai Bangkong' ? 'selected' : '' }}>
            UPT Klinik Utama Sungai Bangkong
        </option>

        <option value="UPT Klinik Pratama"
            {{ request('upt_unit') == 'UPT Klinik Pratama' ? 'selected' : '' }}>
            UPT Klinik Pratama
        </option>

        <option value="UPT Laboratorium Kesehatan"
            {{ request('upt_unit') == 'UPT Laboratorium Kesehatan' ? 'selected' : '' }}>
            UPT Laboratorium Kesehatan
        </option>

        <option value="UPT Pelatihan Kesehatan"
            {{ request('upt_unit') == 'UPT Pelatihan Kesehatan' ? 'selected' : '' }}>
            UPT Pelatihan Kesehatan
        </option>

    </select>

</form>

{{-- ===================== --}}
{{-- FORM TAMBAH --}}
{{-- ===================== --}}
<div class="bg-white shadow rounded-2xl p-5 mb-6">

<h2 class="text-xl font-bold text-green-700 mb-4">
    Tambah Data Pegawai UPT
</h2>

<form action="/upt/store" method="POST"
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

    <input type="number" name="batas_usia_pensiun" placeholder="BUP" class="border p-2 rounded">

    <select name="upt_unit" class="border p-2 rounded md:col-span-3" required>
        <option value="">-- Pilih UPT --</option>
        <option>UPT Klinik Utama Sungai Bangkong</option>
        <option>UPT Klinik Pratama</option>
        <option>UPT Laboratorium Kesehatan</option>
        <option>UPT Pelatihan Kesehatan</option>
    </select>

    <button class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-xl md:col-span-3">
        Simpan Data
    </button>

</form>

</div>

{{-- ===================== --}}
{{-- UPLOAD NORMAL --}}
{{-- ===================== --}}
<div class="bg-white shadow rounded-2xl p-5 mb-6">

<h2 class="text-xl font-bold text-green-700 mb-4">
    Upload Excel / CSV UPT (Normal)
</h2>

<form action="/upt/upload"
      method="POST"
      enctype="multipart/form-data"
      class="flex gap-3">

    @csrf

    <input type="file" name="file" class="border p-2 rounded w-full" required>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-xl">
        Upload File
    </button>

</form>

</div>

{{-- ===================== --}}
{{-- AUTO CLEAN --}}
{{-- ===================== --}}
<div class="bg-white shadow rounded-2xl p-5 mb-6">

<h2 class="text-xl font-bold text-purple-700 mb-4">
    Auto Clean Import UPT
</h2>

<form action="/upt/upload-clean"
      method="POST"
      enctype="multipart/form-data"
      class="flex gap-3">

    @csrf

    <input type="file" name="file" class="border p-2 rounded w-full" required>

    <button class="bg-purple-600 text-white px-4 py-2 rounded-xl">
        Auto Clean Import
    </button>

</form>

</div>

{{-- ===================== --}}
{{-- TABLE --}}
{{-- ===================== --}}
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
    <th class="p-3">UPT</th>
    <th class="p-3 text-center">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($upt ?? [] as $u)

<tr class="border-b hover:bg-green-50">

    <td class="p-3">{{ $u->nip }}</td>
    <td class="p-3">{{ $u->nama_pegawai }}</td>
    <td class="p-3">{{ $u->jenis_kelamin }}</td>
    <td class="p-3">{{ $u->pendidikan }}</td>
    <td class="p-3">{{ $u->jabatan }}</td>
    <td class="p-3">{{ $u->status_pegawai }}</td>
    <td class="p-3">{{ $u->tmt_pensiun }}</td>
    <td class="p-3">{{ $u->batas_usia_pensiun }}</td>
    <td class="p-3">{{ $u->upt_unit }}</td>

    <td class="p-3">
        <div class="flex gap-2">

            <a href="/upt/edit/{{ $u->id }}"
               class="bg-yellow-500 text-white px-3 py-1 rounded">
                Edit
            </a>

            <form action="/upt/delete/{{ $u->id }}" method="POST">
                @csrf
                @method('DELETE')

                <button onclick="return confirm('Hapus data?')"
                        class="bg-red-600 text-white px-3 py-1 rounded">
                    Hapus
                </button>

            </form>

        </div>
    </td>

</tr>

@empty

<tr>
    <td colspan="10" class="text-center p-6 text-gray-500">
        Belum ada data UPT
    </td>
</tr>

@endforelse

</tbody>

</table>

</div>

@endsection