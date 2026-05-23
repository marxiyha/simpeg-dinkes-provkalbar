<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md border border-gray-200">

        <!-- HEADER INSTANSI -->
        <div class="text-center mb-6">

            <h1 class="text-lg font-bold text-gray-800 leading-snug">
                SISTEM INFORMASI DINAS KESEHATAN
                <br>
                PROVINSI KALIMANTAN BARAT
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Registrasi Akun Pengguna Sistem
            </p>

        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAME -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Lengkap')" />

                <x-text-input id="name"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required
                              autofocus
                              autocomplete="name" />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email Resmi')" />

                <x-text-input id="email"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autocomplete="username" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="password"
                              name="password"
                              required
                              autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

                <x-text-input id="password_confirmation"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- BUTTON -->
            <x-primary-button class="w-full flex justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700">
                {{ __('DAFTAR AKUN') }}
            </x-primary-button>

            <!-- LOGIN LINK -->
            <div class="text-center mt-4 text-sm">

                <span class="text-gray-600">
                    Sudah punya akun?
                </span>

                <a href="{{ route('login') }}"
                   class="text-blue-600 font-semibold hover:underline">
                    Login
                </a>

            </div>

        </form>

        <!-- FOOTER -->
        <div class="text-center mt-6 text-xs text-gray-400">
            © {{ date('Y') }} Dinas Kesehatan Provinsi Kalimantan Barat
        </div>

    </div>

</div>

</x-guest-layout>