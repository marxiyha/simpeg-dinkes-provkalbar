@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-green-800 tracking-tight">Pusat Export Data</h1>
        <p class="text-gray-600 mt-2 text-lg">Kelola dan unduh laporan data sistem ke format Excel atau PDF.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200 hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-bold text-green-700 mb-2">Dinas Kesehatan</h2>
            <p class="text-gray-500 mb-6 text-sm">Export seluruh data pegawai internal Dinas Kesehatan.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('dinkes.index') }}" class="text-sm font-semibold text-green-700 hover:text-green-900 underline py-2">Lihat Data</a>
                <a href="/export/pegawai/excel" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">Excel</a>
                <a href="/export/pegawai/pdf" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">PDF</a>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200 hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-bold text-emerald-700 mb-2">Unit Pelaksana Teknis (UPT)</h2>
            <p class="text-gray-500 mb-6 text-sm">Data pegawai dari 4 UPT terdaftar (Satu UPT per Sheet).</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('upt.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900 underline py-2">Lihat Data</a>
                <a href="/export/upt/excel" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">Excel All UPT</a>
                <a href="/export/upt/pdf" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">PDF All UPT</a>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200 hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-bold text-yellow-700 mb-2">Pengajuan Cuti</h2>
            <p class="text-gray-500 mb-6 text-sm">Riwayat pengajuan cuti seluruh pegawai.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('cuti.index') }}" class="text-sm font-semibold text-yellow-700 hover:text-yellow-900 underline py-2">Lihat Data</a>
                <a href="/export/cuti/excel" class="bg-yellow-600 hover:bg-yellow-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">Excel</a>
                <a href="/export/cuti/pdf" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">PDF</a>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200 hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-bold text-blue-700 mb-2">Kalender Dinas Luar</h2>
            <p class="text-gray-500 mb-6 text-sm">Jadwal kegiatan luar kantor pegawai.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('kalender.index') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900 underline py-2">Lihat Jadwal</a>
                <a href="/export/kalender/excel" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">Excel</a>
                <a href="/export/kalender/pdf" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition">PDF</a>
            </div>
        </div>

    </div>

    <div class="mt-12 bg-green-50 p-8 rounded-2xl border border-green-100 shadow-inner">
        <h3 class="font-bold text-green-900 text-lg mb-2">Informasi Penting:</h3>
        <ul class="list-disc ml-5 space-y-2 text-green-800 text-sm">
            <li>Data yang di-export mencakup <b>Nama, Email, NIP, Unit Kerja, Jabatan, Status Pegawai, Jenis Kelamin, dan Tanggal Lahir</b>.</li>
            <li>Export UPT akan menghasilkan satu file Excel dengan sheet terpisah untuk setiap unit.</li>
            <li>Pastikan koneksi stabil saat proses unduhan data berkapasitas besar.</li>
        </ul>
    </div>
</div>
@endsection