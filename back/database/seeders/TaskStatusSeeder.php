<?php

namespace Database\Seeders;

use App\Domain\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::query()->upsert([
            ['id' => 1, 'name' => 'Pendente'],
            ['id' => 2, 'name' => 'Em Andamento'],
            ['id' => 3, 'name' => 'Concluída']
        ], ['id'], ['name']);
    }
}
