@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold text-green-700 mb-8">
Pengajuan Cuti
</h1>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- FILTER -->
<div class="grid grid-cols-5 gap-4 mb-6">

<input type="text" placeholder="Cari Pegawai..." class="border p-4 rounded-xl">

<select class="border p-4 rounded-xl">
<option>2026</option>
<option>2027</option>
<option>2028</option>
</select>

<select class="border p-4 rounded-xl">
<option>Menunggu</option>
<option>Disetujui</option>
<option>Ditolak</option>
</select>

</div>

<!-- TABLE -->
<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

<table class="w-full">

<thead class="bg-green-700 text-white">
<tr>
<th class="p-4">Nama</th>
<th class="p-4">Jenis Cuti</th>
<th class="p-4">Tanggal</th>
<th class="p-4">Status</th>
<th class="p-4">Bidang</th>
<th class="p-4">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($cuti ?? [] as $c)
<tr class="border-b">

<td class="p-4">{{ $c->nama }}</td>
<td class="p-4">{{ $c->jenis_cuti }}</td>
<td class="p-4">{{ $c->tanggal_mulai }} - {{ $c->tanggal_selesai }}</td>

<td class="p-4">

<form method="POST" action="/cuti/update/{{ $c->id }}">
@csrf

<select name="status_pengajuan" class="border rounded-lg p-2">
<option {{ $c->status_pengajuan == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
<option {{ $c->status_pengajuan == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
<option {{ $c->status_pengajuan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
</select>

</td>

<td class="p-4">{{ $c->bidang }}</td>

<td class="p-4 flex gap-2">

<button type="submit"
class="bg-green-700 text-white px-4 py-2 rounded-lg">
Simpan
</button>

</form>

<!-- DELETE -->
<form method="POST" action="/cuti/delete/{{ $c->id }}">
@csrf
@method('DELETE')

<button class="bg-red-600 text-white px-4 py-2 rounded-lg">
Hapus
</button>

</form>

</td>

</tr>
@endforeach

</tbody>

</table>

</div>

<!-- CHART -->
<div class="grid grid-cols-2 gap-6 mt-10">

<div class="bg-white p-6 rounded-3xl shadow-lg">

<h2 class="text-2xl font-bold text-green-700 mb-5">
Grafik Pengajuan Cuti
</h2>

<canvas id="cutiChart"></canvas>

</div>

<div class="bg-white p-6 rounded-3xl shadow-lg">

<h2 class="text-2xl font-bold text-green-700 mb-5">
Jenis Cuti Terbanyak
</h2>

<canvas id="jenisChart"></canvas>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('cutiChart'), {
type: 'bar',
data: {
labels: ['Disetujui', 'Ditolak', 'Menunggu'],
datasets: [{
label: 'Jumlah',
data: [20, 5, 9]
}]
}
});

new Chart(document.getElementById('jenisChart'), {
type: 'pie',
data: {
labels: ['Tahunan', 'Sakit', 'Melahirkan'],
datasets: [{
data: [12, 5, 3]
}]
}
});

</script>

@endsection