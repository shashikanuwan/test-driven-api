<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabelFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'color' => $this->faker->colorName,
            'user_id' => User::factory(),
        ];
    }
}
