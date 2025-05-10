<?php

namespace Database\Factories;

use App\Domain\Models\Comment;
use App\Domain\Models\Task;
use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'task_id' => Task::inRandomOrder()->first()->id ?? Task::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
