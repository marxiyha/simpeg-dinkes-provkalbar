@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-green-800">Manajemen Pengguna</h1>
        <p class="text-gray-500">Administrasi sistem untuk pengelolaan akun pengguna dan hak akses.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-4 rounded-xl mb-6 shadow-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-10">
        <h2 class="text-lg font-bold text-gray-700 mb-6 uppercase tracking-wider border-b pb-2">
            Formulir Pendaftaran Pengguna Baru
        </h2>

        <form method="POST" action="{{ route('users.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Username</label>
                <input type="text" name="username" class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Alamat Email</label>
                <input type="email" name="email" class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Password Akun</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Hak Akses / Role</label>
                <select name="role" class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500" required>
                    <option value="" disabled selected>Pilih Role...</option>
                    <option value="Admin">Admin</option>
                    <option value="Petinggi">Petinggi</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Operator">Operator</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full md:w-auto px-8 py-3 bg-green-700 text-white font-bold rounded-lg hover:bg-green-800 transition shadow-lg">
                    Tambah Pengguna
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-700 uppercase tracking-wider">Daftar Pengguna Terdaftar</h2>
            
            <div class="w-full md:w-64 mt-4 md:mt-0">
                <input type="text" id="userSearch" onkeyup="searchUsers()" placeholder="Cari user..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse" id="userTable">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="p-4 text-left text-sm font-bold text-gray-600 uppercase">Username</th>
                        <th class="p-4 text-left text-sm font-bold text-gray-600 uppercase">Email</th>
                        <th class="p-4 text-left text-sm font-bold text-gray-600 uppercase">Role</th>
                        <th class="p-4 text-center text-sm font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $u)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 font-medium text-gray-800">{{ $u->username }}</td>
                        <td class="p-4 text-gray-600">{{ $u->email }}</td>
                        <td class="p-4">
                            <form method="POST" action="{{ route('users.update', $u->id) }}">
                                @csrf @method('PUT')
                                <select name="role" onchange="this.form.submit()" 
                                        class="bg-gray-100 border-none rounded-md text-sm font-semibold text-green-700 cursor-pointer">
                                    <option value="Admin" {{ $u->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Petinggi" {{ $u->role == 'Petinggi' ? 'selected' : '' }}>Petinggi</option>
                                    <option value="Pegawai" {{ $u->role == 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                                    <option value="Operator" {{ $u->role == 'Operator' ? 'selected' : '' }}>Operator</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-4 text-center">
                            <form method="POST" action="{{ route('users.destroy', $u->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function searchUsers() {
    let input = document.getElementById("userSearch").value.toLowerCase();
    let table = document.getElementById("userTable");
    let tr = table.getElementsByTagName("tr");
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td");
        let found = false;
        for (let j = 0; j < td.length - 1; j++) {
            if (td[j].innerText.toLowerCase().indexOf(input) > -1) {
                found = true;
            }
        }
        tr[i].style.display = found ? "" : "none";
    }
}
</script>
@endsection