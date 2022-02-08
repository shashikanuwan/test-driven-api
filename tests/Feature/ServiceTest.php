<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_connect_to_a_service_and_token_is_stored()
    {
        $this->authUser();
        $responce = $this->getJson(route('service.connect', 'google-drive'))
            ->assertOk()
            ->json();

        $this->assertNotNull($responce['url']);
    }
}
