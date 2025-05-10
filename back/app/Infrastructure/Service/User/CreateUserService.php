<?php

namespace App\Infrastructure\Service\User;

use App\Domain\Dto\UserLoggedResponseDto;
use App\Domain\Models\User;
use App\Domain\Service\CreateUserServiceInterface;
use App\Http\Request\User\CreateUserPostRequest;

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
