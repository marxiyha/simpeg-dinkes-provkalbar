<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

test('confirm password screen can be rendered', function () {
    if (! Route::has('password.confirm')) {
        $this->markTestSkipped('Password confirmation route not registered.');
    }

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    if (! Route::has('password.confirm')) {
        $this->markTestSkipped('Password confirmation route not registered.');
    }

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    if (! Route::has('password.confirm')) {
        $this->markTestSkipped('Password confirmation route not registered.');
    }

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
