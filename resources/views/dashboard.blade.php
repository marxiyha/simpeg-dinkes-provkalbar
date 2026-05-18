




@extends('layouts.app')

@section('title', 'Dashboard Super Admin')

@section('page-title', 'Dashboard Super Admin')

@section('content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-4xl font-bold text-green-700">
            Dashboard Admin
        </h1>

        <p class="text-gray-600">
            Sistem Dinas Kesehatan & 4 UPT
        </p>
    </div>

    <!-- QUICK ACTION BUTTON -->
    <div class="flex gap-3">

        <!-- MENU KE DATA UPT -->
        <a href="/upt"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl shadow">

            + Tambah UPT

        </a>

        <!-- MENU KE DATA DINKES -->
        <a href="/dinkes"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl shadow">

            + Tambah Dinkes

        </a>

        <!-- EXPORT -->
        <a href="/export"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl shadow">

            Export Data

        </a>

    </div>

</div>

<!-- STATISTIK CLICKABLE -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <!-- DINKES -->
    <a href="/dinkes"
       class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition block">

        <h2 class="font-bold text-gray-700">
            Dinas Kesehatan
        </h2>

        <p class="text-5xl font-bold text-green-700">
            {{ $dinkes ?? 0 }}
        </p>

        <p class="text-sm text-gray-500 mt-2">
            Klik untuk detail
        </p>

    </a>

    <!-- UPT -->
    <a href="/upt"
       class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition block">

        <h2 class="font-bold text-gray-700">
            4 UPT
        </h2>

        <p class="text-5xl font-bold text-green-700">
            {{ $totalUpt ?? 0 }}
        </p>

        <p class="text-sm text-gray-500 mt-2">
            Klik untuk detail
        </p>

    </a>

    <!-- REKAP -->
    <a href="/rekapitulasi"
       class="bg-white p-6 rounded-3xl shadow hover:shadow-xl transition block">

        <h2 class="font-bold text-gray-700">
            Rekapitulasi
        </h2>

        <p class="text-5xl font-bold text-green-700">
            {{ ($dinkes ?? 0) + ($totalUpt ?? 0) }}
        </p>

        <p class="text-sm text-gray-500 mt-2">
            Klik untuk lihat rekap
        </p>

    </a>

</div>

<!-- GRAFIK -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-10">

    <!-- GRAFIK PEGAWAI -->
    <div class="bg-white p-6 rounded-3xl shadow">

        <h2 class="text-xl font-bold text-green-700 mb-5">
            Pegawai Dinkes vs UPT
        </h2>

        <canvas id="pegawaiChart"></canvas>

    </div>

    <!-- GRAFIK CUTI -->
    <div class="bg-white p-6 rounded-3xl shadow">

        <h2 class="text-xl font-bold text-green-700 mb-5">
            Status Cuti
        </h2>

        <canvas id="cutiChart"></canvas>

    </div>

</div>

<!-- QUICK ACTION PANEL -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <!-- CUTI -->
    <a href="/cuti"
       class="bg-white p-5 rounded-2xl shadow hover:bg-green-50 transition">

        📄 Pengajuan Cuti

    </a>

    <!-- KALENDER -->
    <a href="/kalender"
       class="bg-white p-5 rounded-2xl shadow hover:bg-green-50 transition">

        📅 Kalender Dinas

    </a>

    <!-- USER -->
    <a href="/users"
       class="bg-white p-5 rounded-2xl shadow hover:bg-green-50 transition">

        👥 Manajemen User

    </a>


</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // =======================
    // GRAFIK PEGAWAI
    // =======================

    new Chart(document.getElementById('pegawaiChart'), {

        type: 'bar',

        data: {

            labels: ['Dinkes', '4 UPT'],

            datasets: [{

                label: 'Pegawai',

                data: [
                    {{ $dinkes ?? 0 }},
                    {{ $totalUpt ?? 0 }}
                ],

                backgroundColor: [
                    '#15803d',
                    '#22c55e'
                ]

            }]
        }

    });

    // =======================
    // GRAFIK CUTI
    // =======================

    new Chart(document.getElementById('cutiChart'), {

        type: 'pie',

        data: {

            labels: [
                'Disetujui',
                'Ditolak',
                'Menunggu'
            ],

            datasets: [{

                data: [
                    {{ $cuti['disetujui'] ?? 0 }},
                    {{ $cuti['ditolak'] ?? 0 }},
                    {{ $cuti['menunggu'] ?? 0 }}
                ],

                backgroundColor: [
                    '#16a34a',
                    '#dc2626',
                    '#eab308'
                ]

            }]
        }

    });

});

</script>

@endpush