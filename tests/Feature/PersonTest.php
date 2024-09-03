<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

test('person_can_get', function () {

    $token = Config::get('sanctum.master_key');

    $response = $this->withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $token
    ])->postJson('/api/person/params?limit=1');

    if ($response->getStatusCode() !== 200 || !$response->json()['ok']) {
        Log::channel('single')->debug('Error al obtener personas', [
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
    $this->assertGreaterThan(0, count($response->json()['data']));
});

test('person_can_update', function () {

    $token = Config::get('sanctum.master_key');

    $response = $this->withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $token
    ])->putJson('/api/person', [  
        "id" => 1,
        "status" => 1,
        "additionalData" => [ "addresses" => [] ],

    ]);

    if ($response->getStatusCode() !== 200 || !$response->json()['ok']) {
        Log::channel('single')->debug('Error al actualizar persona', [
            'id' => 1,
            'status' => 1,
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
    $this->assertTrue($response->json()['ok']);
});

