<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
        $this->user =  $this->authUser();
    }

    public function test_a_user_can_connect_to_a_service_and_token_is_stored()
    {
        $responce = $this->getJson(route('web-service.connect', 'google-drive'))
            ->assertOk()
            ->json();

        $this->assertNotNull($responce['url']);
    }

    public function test_service_callback_will_store_token()
    {
        $responce = $this->postJson(route('web-service.callback'), [
            'code' => 'dummy'
        ])
            ->assertCreated();

        $this->assertDatabaseHas('web_services', ['user_id' => $this->user->id]);

        // $this->assertNotNull($this->user->services->first()->token);
    }
}
