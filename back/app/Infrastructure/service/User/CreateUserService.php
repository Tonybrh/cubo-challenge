<?php

namespace App\Infrastructure\service\User;

use App\domain\dto\UserLoggedResponseDto;
use App\domain\Models\User;
use App\domain\Service\CreateUserServiceInterface;
use App\Http\Request\CreateUserPostRequest;

class CreateUserService implements CreateUserServiceInterface
{
    public function __invoke(CreateUserPostRequest $request): UserLoggedResponseDto
    {
        $user = User::query()->create($request->validated());

        return new UserLoggedResponseDto(
            $user->createToken('auth_token')->plainTextToken,
            'Bearer'
        );
    }
}
