<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph,
            'todo_list_id' => TodoList::factory(),
            'label_id' => Label::factory(),
        ];
    }
}
