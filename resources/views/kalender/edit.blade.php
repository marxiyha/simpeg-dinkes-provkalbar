@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-green-700 mb-6">
    Edit Kalender Dinas Luar
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white p-6 rounded-xl shadow">

<form method="POST" action="/kalender/update/{{ $data->id }}" class="space-y-4">
    @csrf

    <input type="text"
           name="nama_pegawai"
           value="{{ $data->nama_pegawai }}"
           class="border p-3 rounded w-full"
           required>

    <input type="date"
           name="tanggal"
           value="{{ $data->tanggal_dinas }}"
           class="border p-3 rounded w-full"
           required>

    <input type="text"
           name="lokasi"
           value="{{ $data->lokasi }}"
           class="border p-3 rounded w-full"
           required>

    <textarea name="keterangan"
              class="border p-3 rounded w-full">{{ $data->keterangan }}</textarea>

    <input type="text"
           name="tag_user"
           value="{{ $data->tag_user }}"
           class="border p-3 rounded w-full">

    <button class="bg-green-700 text-white px-6 py-3 rounded">
        Update Data
    </button>

</form>

</div>

@endsection