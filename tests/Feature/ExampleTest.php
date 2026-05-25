<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a pagina inicial abre', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Gestao de Contactos');
});
