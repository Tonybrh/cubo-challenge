<?php

namespace App\Http\Action\Task;

use App\Domain\Service\Task\TaskByStatusServiceInterface;
use App\Http\Request\Task\TaskStatusDateFilteredRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class TaskByStatusGetAction
{
    public function __construct(
        private TaskByStatusServiceInterface $taskByStatusService
    ) {
    }

    public function __invoke(TaskStatusDateFilteredRequest $request): JsonResponse
    {
        return new JsonResponse(
            ($this->taskByStatusService)($request->status, $request->user()->id),
            Response::HTTP_OK
        );
    }
}
