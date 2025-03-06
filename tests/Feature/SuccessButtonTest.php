<?php

namespace Tests\Feature;

use Tests\TestCase;

class SuccessButtonTest extends TestCase
{
    /** @test */
    public function it_loads_the_success_button_page()
    {
        $response = $this->get('/success-button');

        $response->assertStatus(200);
        $response->assertSee('Mostrar Notificación');
        $response->assertSee('<button', false); // Verifica que hay un botón en la página
        $response->assertSeeLivewire('success-notification-button');
    }
}
