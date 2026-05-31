@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-700">Monitoring Data UPT</h1>
        <a href="/dashboard" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-xl text-sm font-semibold transition">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- FILTER & SEARCH --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border mb-6 flex flex-col md:flex-row gap-4 items-center">
        <form method="GET" action="/upt" class="flex-1 w-full">
            <label class="font-bold text-green-700 text-sm">Pilih UPT:</label>
            <select name="upt_unit" onchange="this.form.submit()" class="border p-2 rounded ml-2 w-full md:w-64">
                <option value="">-- Semua UPT --</option>
                <option value="UPT Klinik Utama Sungai Bangkong" {{ request('upt_unit') == 'UPT Klinik Utama Sungai Bangkong' ? 'selected' : '' }}>UPT Klinik Utama Sungai Bangkong</option>
                <option value="UPT Klinik Pratama" {{ request('upt_unit') == 'UPT Klinik Pratama' ? 'selected' : '' }}>UPT Klinik Pratama</option>
                <option value="UPT Laboratorium Kesehatan" {{ request('upt_unit') == 'UPT Laboratorium Kesehatan' ? 'selected' : '' }}>UPT Laboratorium Kesehatan</option>
                <option value="UPT Pelatihan Kesehatan" {{ request('upt_unit') == 'UPT Pelatihan Kesehatan' ? 'selected' : '' }}>UPT Pelatihan Kesehatan</option>
            </select>
        </form>

        <form method="GET" action="/upt" class="flex-1 w-full md:w-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIP..." 
                   class="border p-2 rounded w-full md:w-64">
            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg ml-2 hover:bg-green-800 transition">
                Cari
            </button>
        </form>
    </div>

    {{-- TABLE DATA (READ-ONLY) --}}
    <div class="bg-white shadow rounded-2xl overflow-hidden border">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">NIP</th>
                        <th class="p-4">Unit Kerja (ID)</th>
                        <th class="p-4">Jabatan</th>
                        <th class="p-4">Status Pegawai</th>
                        <th class="p-4">Jenis Kelamin</th>
                        <th class="p-4">Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($upt ?? [] as $u)
                    <tr class="hover:bg-green-50 transition">
                        <td class="p-4 font-medium text-gray-800">{{ $u->nama_pegawai }}</td>
                        <td class="p-4">{{ $u->email ?? '-' }}</td>
                        <td class="p-4 font-mono">{{ $u->nip }}</td>
                        <td class="p-4">{{ $u->upt_unit }}</td>
                        <td class="p-4">{{ $u->jabatan }}</td>
                        <td class="p-4">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $u->status_pegawai }}
                            </span>
                        </td>
                        <td class="p-4">{{ $u->jenis_kelamin }}</td>
                        <td class="p-4">{{ $u->tanggal_lahir ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center p-10 text-gray-500">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection