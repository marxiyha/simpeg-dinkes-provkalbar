@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-green-700">
        Manajemen User
    </h1>
    <p class="text-gray-500">
        Kelola user (Admin / Petinggi / Pegawai / Operator)
    </p>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5">
        {{ session('success') }}
    </div>
@endif

{{-- ================= FORM TAMBAH USER ================= --}}
<div class="bg-white p-6 rounded-2xl shadow mb-8">

    <h2 class="text-xl font-semibold mb-4 text-green-700">
        Tambah User
    </h2>

    <form method="POST" action="{{ route('users.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        {{-- USERNAME --}}
        <div class="flex flex-col">
            <label class="text-gray-600 mb-1 text-sm">Username</label>
            <input type="text"
                   name="username"
                   value="{{ old('username') }}"
                   placeholder="Username"
                   class="border p-3 rounded-xl focus:outline-green-700 @error('username') border-red-500 @enderror"
                   required>
            @error('username') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- EMAIL --}}
        <div class="flex flex-col">
            <label class="text-gray-600 mb-1 text-sm">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Email"
                   class="border p-3 rounded-xl focus:outline-green-700 @error('email') border-red-500 @enderror"
                   required>
            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- HAK AKSES / ROLE (SUDAH DIPERBAIKI) --}}
        <div class="flex flex-col">
            <label class="text-gray-600 mb-1 text-sm">Hak Akses / Role</label>
            <select name="role"
                    class="border p-3 rounded-xl focus:outline-green-700 @error('role') border-red-500 @enderror"
                    required>
                <option value="">-- Pilih Role --</option>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Petinggi" {{ old('role') == 'Petinggi' ? 'selected' : '' }}>Petinggi</option>
                <option value="Pegawai" {{ old('role') == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                <option value="Operator" {{ old('role') == 'Operator' ? 'selected' : '' }}>Operator</option>
            </select>
            @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="md:col-span-2 mt-2">
            <button type="submit"
                    class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800 transition">
                Simpan User
            </button>
        </div>

    </form>
</div>

{{-- ================= TABLE USER ================= --}}
<div class="bg-white p-6 rounded-2xl shadow">

    <h2 class="text-xl font-semibold mb-4 text-green-700">
        Daftar User
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full border">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Username</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $u->id }}</td>
                        <td class="p-3">{{ $u->name }}</td>
                        <td class="p-3">{{ $u->username }}</td>
                        <td class="p-3">{{ $u->email }}</td>
                        <td class="p-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td class="p-3 flex justify-center gap-2">
                            {{-- DELETE BUTTON --}}
                            <form method="POST" action="/users/delete/{{ $u->id }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            Belum ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection