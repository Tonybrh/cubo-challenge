<?php

namespace App\Http\Action\Task;

use App\Domain\Models\Task;
use App\Domain\Service\Task\EditTaskServiceInterface;
use App\Http\Request\EditTaskPutRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class EditTaskPutAction
{
    use AuthorizesRequests;
    public function __construct(
      private EditTaskServiceInterface $editTaskService
    ) {
    }

    public function __invoke(EditTaskPutRequest $request, int $task): JsonResponse
    {
        $user = $request->user();
        $task = Task::query()->findOrFail($task);
        if($user->cannot('update', $task)) {
            throw new AuthorizationException();
        }

        $taskData = array_merge($request->validated(), [
            'user_id' => $user->id,
            'id' => $task->id
        ]);

        return new JsonResponse(
            ($this->editTaskService)($taskData),
            Response::HTTP_OK
        );
    }
}
