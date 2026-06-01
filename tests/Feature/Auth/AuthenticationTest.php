<?php

use App\Models\User;

/**
 * Aplikasi ini menggunakan alur login kustom dua jalur + OTP.
 * - /login/pegawai → untuk pegawai, operator, admin
 * - /login/petinggi → untuk petinggi, superadmin
 * Login yang berhasil tidak langsung mengautentikasi user — user diarahkan ke halaman OTP.
 */
test('login screen (pegawai) can be rendered', function () {
    $response = $this->get('/login/pegawai');

    $response->assertStatus(200);
});

test('login screen (petinggi) can be rendered', function () {
    $response = $this->get('/login/petinggi');

    $response->assertStatus(200);
});

test('/login redirects to /login/pegawai', function () {
    $response = $this->get('/login');

    $response->assertRedirect('/login/pegawai');
});

test('users are redirected to otp after valid credentials', function () {
    $user = User::factory()->create();

    $response = $this->post('/login/pegawai', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    // Dengan OTP aktif, user diredirect ke halaman OTP — belum ter-autentikasi
    $response->assertRedirect(route('otp.form'));
    $this->assertGuest();
});

test('users cannot authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login/pegawai', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect(route('login'));
});
