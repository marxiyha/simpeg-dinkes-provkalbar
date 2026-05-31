@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-700">Monitoring Data Dinas Kesehatan</h1>
        <a href="/dashboard" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-xl text-sm font-semibold transition">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- SEARCH BAR --}}
    <div class="bg-white p-5 rounded-2xl shadow-sm border mb-6">
        <form method="GET" action="/dinkes" class="flex flex-col md:flex-row gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari berdasarkan Nama, NIP, atau Email..." 
                   class="border p-2 rounded-lg flex-1">
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition">
                Cari Data
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
                        <th class="p-4">Unit Kerja</th>
                        <th class="p-4">Jabatan</th>
                        <th class="p-4">Status Pegawai</th>
                        <th class="p-4">Jenis Kelamin</th>
                        <th class="p-4">Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($dinkes ?? [] as $d)
                    <tr class="hover:bg-green-50 transition">
                        <td class="p-4 font-medium text-gray-800">{{ $d->nama_pegawai }}</td>
                        <td class="p-4">{{ $d->email ?? '-' }}</td>
                        <td class="p-4 font-mono">{{ $d->nip }}</td>
                        <td class="p-4">{{ $d->unit_kerja ?? 'Dinas Kesehatan' }}</td>
                        <td class="p-4">{{ $d->jabatan }}</td>
                        <td class="p-4">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $d->status_pegawai }}
                            </span>
                        </td>
                        <td class="p-4">{{ $d->jenis_kelamin }}</td>
                        <td class="p-4">{{ $d->tanggal_lahir ?? '-' }}</td>
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