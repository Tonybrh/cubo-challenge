<?php

namespace App\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginUserPostResource extends JsonResource
{
    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)->setStatusCode(Response::HTTP_OK);
    }

    public function toArray(Request $request): array
    {
        return [
            'accessToken' => $this->accessToken,
            'tokenType' => $this->tokenType,
        ];
    }
}
