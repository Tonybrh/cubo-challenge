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
        $statuses = [
            ['name' => 'Pendente'],
            ['name' => 'Em Andamento'],
            ['name' => 'Concluída'],
        ];

        foreach ($statuses as $status) {
            TaskStatus::firstOrCreate($status);
        }
    }
}
