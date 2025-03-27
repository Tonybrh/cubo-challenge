<?php

namespace Database\Factories;

use App\Domain\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskStatusFactory extends Factory
{
    protected $model = TaskStatus::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Pendente',
                'Em Andamento',
                'Concluída'
            ]),
        ];
    }
}
