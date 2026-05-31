@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-green-700 mb-5">
    Edit Data Dinkes
</h1>

<form method="POST"
      action="/data-dinkes/update/{{ $data->id }}"
      class="grid grid-cols-3 gap-3">

@csrf

<input type="text"
       name="nip"
       value="{{ $data->nip }}"
       class="border p-2 rounded">

<input type="text"
       name="nama_pegawai"
       value="{{ $data->nama_pegawai }}"
       class="border p-2 rounded">

<input type="text"
       name="jenis_kelamin"
       value="{{ $data->jenis_kelamin }}"
       class="border p-2 rounded">

<input type="text"
       name="pendidikan"
       value="{{ $data->pendidikan }}"
       class="border p-2 rounded">

<input type="text"
       name="jabatan"
       value="{{ $data->jabatan }}"
       class="border p-2 rounded">

<input type="text"
       name="status_pegawai"
       value="{{ $data->status_pegawai }}"
       class="border p-2 rounded">

<input type="date"
       name="tmt_pensiun"
       value="{{ $data->tmt_pensiun }}"
       class="border p-2 rounded">

<input type="number"
       name="batas_usia_pensiun"
       value="{{ $data->batas_usia_pensiun }}"
       class="border p-2 rounded">

<input type="email"
       name="email"
       value="{{ $data->email }}"
       class="border p-2 rounded">

<input type="date"
       name="prediksi_naik_gaji"
       value="{{ $data->prediksi_naik_gaji }}"
       class="border p-2 rounded">

<input type="date"
       name="prediksi_naik_pangkat"
       value="{{ $data->prediksi_naik_pangkat }}"
       class="border p-2 rounded">

<select name="role"
        class="border p-2 rounded">

    <option value="Pegawai"
        {{ $data->role == 'Pegawai' ? 'selected' : '' }}>
        Pegawai
    </option>

    <option value="Petinggi"
        {{ $data->role == 'Petinggi' ? 'selected' : '' }}>
        Petinggi
    </option>

    <option value="Admin"
        {{ $data->role == 'Admin' ? 'selected' : '' }}>
        Admin
    </option>

    <option value="Operator"
        {{ $data->role == 'Operator' ? 'selected' : '' }}>
        Operator
    </option>

</select>

<button class="bg-green-600 hover:bg-green-700 text-white p-3 rounded col-span-3">

    Simpan Perubahan

</button>

</form>

@endsection