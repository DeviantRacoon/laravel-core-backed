<?php
use Illuminate\Support\Facades\Log;

// test('user_can_register', function () {
//     $response = $this->postJson('/api/user/register', [
//         'email' => 'test@gmail.com',
//         'name' => 'test',
//         'password' => '1232345345'
//     ]);

//     $statusCode = $response->getStatusCode();
//     $ok = isset($response->json()['user']);

//     if ($statusCode !== 200 || !$ok) {
//         Log::channel('single')->debug('Error al registrar usuario', [
//             'email' => 'test@gmail.com',
//             'name' => 'test',
//             'password' => '1232345345',
//             'response' => $response->json()
//         ]);
//     }

//     $response->assertStatus(200)
//         ->assertJsonStructure(['access_token', 'token_type', 'user']);
// });


test('user_can_login', function () {
    $response = $this->postJson('/api/user/login', [
        'email' => 'test@gmail.com',
        'password' => '1232345345'
    ]);

    if ($response->getStatusCode() !== 200 || !isset($response->json()['user'])) {
        Log::channel('single')->debug('Error al registrar usuario', [
            'email' => 'test@gmail.com',
            'password' => '1232345345',
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
});
