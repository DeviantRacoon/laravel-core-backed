<?php

use Illuminate\Support\Facades\Log;

test('', function () {
    $response = $this->get('/api/user');

    if ($response->getStatusCode() !== 200 || !$response->json()['ok']) {
        Log::channel('single')->debug('Error al obtener usuarios', [
            'email' => 'test@gmail.com',
            'password' => '1232345345',
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
    $this->assertGreaterThan(1, count($response->json()['data']));
});