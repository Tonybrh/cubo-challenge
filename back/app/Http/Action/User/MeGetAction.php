<?php

namespace App\Http\Action\User;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class MeGetAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            auth()->user(),
            Response::HTTP_OK
        );
    }
}
