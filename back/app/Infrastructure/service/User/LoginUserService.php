<?php

namespace App\Infrastructure\service\User;

use App\Domain\Dto\UserLoggedResponseDto;
use App\Domain\Exception\UnauthorizedException;
use App\Domain\Service\LoginUserServiceInterface;
use App\Http\Request\LoginUserPostRequest;
use Illuminate\Support\Facades\Auth;

class LoginUserService implements LoginUserServiceInterface
{
    public function __invoke(LoginUserPostRequest $request): UserLoggedResponseDto
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedException();
        }

        $user = Auth::user();

        return new UserLoggedResponseDto(
            $user->createToken('auth_token')->plainTextToken,
            'Bearer'
        );
    }
}
