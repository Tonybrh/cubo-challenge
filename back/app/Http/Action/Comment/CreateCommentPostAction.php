<?php

namespace App\Http\Action\Comment;

use App\Domain\Repository\CreateCommentServiceInterface;
use App\Http\Request\Comment\CreateCommentPostRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class CreateCommentPostAction
{
    public function __construct(
        private CreateCommentServiceInterface $commentService
    ) {
    }

    public function __invoke(CreateCommentPostRequest $request): JsonResponse
    {
        $user = $request->user();
        $commentData = array_merge($request->validated(), [
            'user_id' => $user->id
        ]);

        return new JsonResponse(
            ($this->commentService)($commentData),
            Response::HTTP_CREATED
        );
    }
}
