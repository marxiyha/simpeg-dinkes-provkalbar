<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md border border-gray-200">

        <!-- HEADER INSTANSI -->
        <div class="text-center mb-6">

            <h1 class="text-lg font-bold text-gray-800">
                SISTEM INFORMASI DINAS KESEHATAN
                <br>
                PROVINSI KALIMANTAN BARAT
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Reset Password Akun Pengguna
            </p>

        </div>

        <!-- STATUS -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- FORM -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- TOKEN -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- EMAIL -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email Terdaftar')" />

                <x-text-input id="email"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="email"
                              name="email"
                              :value="old('email', request()->email)"
                              required
                              autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- PASSWORD BARU -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password Baru')" />

                <x-text-input id="password"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="password"
                              name="password"
                              required />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />

                <x-text-input id="password_confirmation"
                              class="block mt-1 w-full rounded-md border-gray-300 focus:border-blue-600 focus:ring-blue-600"
                              type="password"
                              name="password_confirmation"
                              required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- BUTTON -->
            <x-primary-button class="w-full flex justify-center bg-blue-600 hover:bg-blue-700">
                {{ __('RESET PASSWORD') }}
            </x-primary-button>

        </form>

        <!-- FOOTER -->
        <div class="text-center mt-6 text-xs text-gray-400">
            © {{ date('Y') }} Dinas Kesehatan Provinsi Kalimantan Barat
        </div>

    </div>

</div>

</x-guest-layout>