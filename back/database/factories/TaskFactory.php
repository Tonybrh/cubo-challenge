<?php

namespace Database\Factories;

use App\Domain\Models\Task;
use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'task_status_id' => $this->faker->numberBetween(1, 3),
            'user_id' => User::factory(),
        ];
    }
}
