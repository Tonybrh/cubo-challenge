<?php

namespace App\Domain\Repository;

use App\Domain\Models\Task;

interface TaskRepositoryInterface
{
    public function save(array $taskData): Task;
}
