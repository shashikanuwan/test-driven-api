<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebServiceFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'google-drive',
            'token' => ['access_token' => 'fake-token'],
            'user_id' => User::factory(),
        ];
    }
}
