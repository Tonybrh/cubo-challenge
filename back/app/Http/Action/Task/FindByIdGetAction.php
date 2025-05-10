<?php

namespace App\Http\Action\Task;

use App\Domain\Service\Task\FindByIdServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class FindByIdGetAction
{
    public function __construct(
        private FindByIdServiceInterface $findByIdService
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        return new JsonResponse(
            ($this->findByIdService)($id),
            Response::HTTP_OK
        );
    }
}
