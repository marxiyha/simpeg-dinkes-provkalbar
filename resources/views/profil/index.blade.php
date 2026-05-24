@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6">
    
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Pengaturan Profil</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6 border border-red-200">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        
        <div class="mb-8">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Informasi Akun</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-xs font-bold text-gray-400 uppercase">Nama Lengkap</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ Auth::user()->name }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-xs font-bold text-gray-400 uppercase">Email</p>
                    <p class="text-gray-900 font-semibold mt-1">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <hr class="my-6 border-gray-100">

        <h2 class="text-lg font-bold text-green-700 mb-4">Keamanan: Ganti Password</h2>
        <form method="POST" action="{{ route('profil.update') }}">
            @csrf
            <div class="space-y-4">
                <input type="password" name="password" 
                       class="w-full border border-gray-200 p-4 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" 
                       placeholder="Masukkan Password Baru" required>
                
                <input type="password" name="password_confirmation" 
                       class="w-full border border-gray-200 p-4 rounded-xl focus:ring-2 focus:ring-green-500 outline-none" 
                       placeholder="Konfirmasi Password Baru" required>
                
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-bold transition">
                    Simpan Password Baru
                </button>
            </div>
        </form>

        <hr class="my-8 border-gray-100">

        <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
            <h2 class="text-lg font-bold text-red-600 mb-2">Danger Zone</h2>
            <p class="text-sm text-red-700 mb-6">
                Menghapus akun akan menghilangkan seluruh data akses Anda secara permanen. 
                Anda tidak akan bisa login kembali menggunakan akun ini.
            </p>
            
            <form method="POST" action="{{ route('profil.delete') }}" 
                  onsubmit="return confirm('PERINGATAN: Akun akan dihapus permanen. Lanjutkan?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-bold transition">
                    Hapus Akun Permanen
                </button>
            </form>
        </div>

    </div>
</div>
@endsection