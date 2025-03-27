<?php

namespace App\Http\Action\Task;

use App\Domain\Models\Task;
use App\Domain\Service\Task\DeleteTaskServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class DeleteTaskAction
{
    public function __construct(
        private DeleteTaskServiceInterface $deleteTaskService
    ) {
    }

    public function __invoke(Request $request, int $taskId): JsonResponse
    {

        $user = $request->user();
        $task = Task::query()->findOrFail($taskId);

        if($user->cannot('delete', $task)) {
            throw new AuthorizationException();
        }

        ($this->deleteTaskService)($taskId);

        return new JsonResponse(
            ["message" => "Tarefa apagada com sucesso !"],
            Response::HTTP_OK
        );
    }
}
