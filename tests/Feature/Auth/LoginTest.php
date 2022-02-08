<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_email_and_password()
    {
        $user = $this->createUser();
        $response = $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => 'password'
        ])
            ->assertOk();

        $this->assertArrayHasKey('token', $response->json());
    }


    public function test_if_user_email_is_not_available_then_it_return_error()
    {
        $this->postJson(route('user.login'), [
            'email' => 'shashika@gmail.com',
            'password' => 'password'
        ])
            ->assertUnauthorized();
    }

    public function test_if_raise_error_if_password_is_incorrect()
    {
        $user = $this->createUser();

        $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => 'random'
        ])
            ->assertUnauthorized();
    }
}
