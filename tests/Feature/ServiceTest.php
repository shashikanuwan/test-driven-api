<?php

namespace Tests\Feature;

use Google\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
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
        $mock = $this->mock(Client::class, function (MockInterface $mock) {
            $mock->shouldReceive('setScopes');
            $mock->shouldReceive('createAuthUrl')
                ->andReturn('http://localhost');
        });

        $responce = $this->getJson(route('web-service.connect', 'google-drive'))
            ->assertOk()
            ->json();

        $this->assertEquals('http://localhost', $responce['url']);
    }

    public function test_service_callback_will_store_token()
    {
        $mock = $this->mock(Client::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetchAccessTokenWithAuthCode')
                ->andReturn('fake-token');
        });

        $responce = $this->postJson(route('web-service.callback'), [
            'code' => 'dummy'
        ])
            ->assertCreated();

        $this->assertDatabaseHas('web_services', [
            'user_id' => $this->user->id,
            'token' => '{"access_token":"fake-token"}'
        ]);

        //$this->assertNotNull($this->user->services->first()->token);
    }
}
