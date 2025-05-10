<?php

namespace App\Domain\Service\Task;

interface DeleteTaskServiceInterface
{
    public function __invoke(int $taskId): void;
}
