<x-guest-layout>

<h1>LUPA PASSWORD</h1>

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="email"
           name="email"
           placeholder="Masukkan Email"
           required>

    <input type="password"
           name="password"
           placeholder="Password Baru"
           required>

    <input type="password"
           name="password_confirmation"
           placeholder="Konfirmasi Password"
           required>

    <button type="submit">
        KIRIM
    </button>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">
            Kembali Login
        </a>
    </div>

</form>

</x-guest-layout>