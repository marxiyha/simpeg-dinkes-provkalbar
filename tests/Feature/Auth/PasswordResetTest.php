<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Aplikasi ini menggunakan alur reset password kustom (bukan token-based Fortify).
 * POST /forgot-password menerima email + password baru, langsung mengupdate password.
 */
test('reset password link screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

test('password can be reset with valid email', function () {
    $user = User::factory()->create();

    $response = $this->post('/forgot-password', [
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('login'));

    $this->assertTrue(
        Hash::check('new-password', $user->refresh()->password)
    );
});

test('reset password fails with non-existent email', function () {
    $response = $this->post('/forgot-password', [
        'email' => 'notfound@example.com',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors('email');
});
