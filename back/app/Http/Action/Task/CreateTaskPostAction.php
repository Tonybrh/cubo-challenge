<?php

namespace App\Http\Action\Task;

use App\Domain\Service\Task\CreateTaskServiceInterface;
use App\Http\Request\Task\CreateTaskPostRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class CreateTaskPostAction
{
    public function __construct(
        private CreateTaskServiceInterface $createTaskService
    ) {
    }

    public function __invoke(CreateTaskPostRequest $request): JsonResponse
    {
        $user = $request->user();

        $taskData = array_merge($request->validated(), [
            'user_id' => $user->id
        ]);

        return new JsonResponse(
            ($this->createTaskService)($taskData),
            Response::HTTP_CREATED
        );
    }
}
