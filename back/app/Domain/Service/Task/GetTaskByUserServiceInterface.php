<?php

namespace App\Domain\Service\Task;

interface GetTaskByUserServiceInterface
{
    public function __invoke(int $user): array;
}
