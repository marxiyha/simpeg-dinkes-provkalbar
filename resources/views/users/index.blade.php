@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-green-700">
        Manajemen User
    </h1>
    <p class="text-gray-500">
        Kelola user (Admin / Operator / Petinggi)
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

    <form method="POST" action="/users/store" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @csrf

        <input type="text"
               name="username"
               placeholder="Username"
               class="border p-3 rounded-xl"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
               class="border p-3 rounded-xl"
               required>

        <select name="role"
                class="border p-3 rounded-xl"
                required>

            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
            <option value="petinggi">Petinggi</option>
            <option value="user">User</option>

        </select>

        <div class="md:col-span-3">
            <button type="submit"
                    class="bg-green-700 text-white px-6 py-3 rounded-xl hover:bg-green-800">
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
                    <th class="p-3 text-left">Username</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $u)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">{{ $u->id }}</td>
                        <td class="p-3">{{ $u->username }}</td>
                        <td class="p-3">{{ $u->email }}</td>
                        <td class="p-3">{{ $u->role }}</td>

                        </td>

                        <td class="p-3 flex gap-2">

                            {{-- DELETE --}}
                            <form method="POST" action="/users/delete/{{ $u->id }}">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            Belum ada data user
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection