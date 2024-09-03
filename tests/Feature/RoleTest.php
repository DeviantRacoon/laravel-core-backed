<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

test('role_can_get', function () {

    $token = Config::get('sanctum.master_key');

    $response = $this->withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $token
    ])->postJson('/api/role/params?limit=1');

    if ($response->getStatusCode() !== 200 || !$response->json()['ok']) {
        Log::channel('single')->debug('Error al obtener roles', [
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
    $this->assertGreaterThan(0, count($response->json()['data']));
});

test('role_can_update', function () {

    $token = Config::get('sanctum.master_key');
    $id = 1;

    $response = $this->withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $token
    ])->putJson('/api/role', [
                "id" => $id,
                "name" => "Administrador",
                "description" => "Administrador del sistema",
            ]);

    if ($response->getStatusCode() !== 200 || !$response->json()['ok']) {
        Log::channel('single')->debug('Error al actualizar rol', [
            'name' => 'Administrador',
            'description' => 'Administrador del sistema',
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
    $this->assertTrue($response->json()['ok']);
});

test('role_can_add_permission', function () {

    $token = Config::get('sanctum.master_key');
    $roleId = 1;
    $permissionId = 1;

    $response = $this->withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $token
    ])->postJson('/api/role/permission', [
                [
                    "roleId" => $roleId,
                    "permissionId" => $permissionId,
                    "status" => 1
                ]
            ]);

    if ($response->getStatusCode() !== 200 || !$response->json()['ok']) {
        Log::channel('single')->debug('Error al agregar rol', [
            'name' => 'Administrador',
            'description' => 'Administrador del sistema',
            'response' => $response->json()
        ]);
    }

    $response->assertStatus(200);
    $this->assertTrue($response->json()['ok']);
});
