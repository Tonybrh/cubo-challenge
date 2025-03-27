<?php

namespace App\Domain\Exception;

use Illuminate\Auth\AuthenticationException;

class UnauthenticatedHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('user.login'));
    }
}
