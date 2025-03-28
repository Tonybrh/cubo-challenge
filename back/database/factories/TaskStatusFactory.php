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

    public function withSpecificIds()
    {
        return $this->state(function (array $attributes) {
            static $id = 0;
            $id++;

            return [
                'id' => $id,
                'name' => match($id) {
                    1 => 'Pendente',
                    2 => 'Em Andamento',
                    3 => 'Concluída',
                    default => $this->faker->word
                }
            ];
        });
    }
}
