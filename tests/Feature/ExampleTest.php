<?php

<<<<<<< HEAD
it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
=======
test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
});
>>>>>>> bb0a2cd02c3ec4a9a481080e2fa3e36501776e74
