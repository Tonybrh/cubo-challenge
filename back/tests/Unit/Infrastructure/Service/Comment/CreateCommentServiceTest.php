<?php

namespace Tests\Unit\Infrastructure\Service\Comment;

use App\Domain\Dto\CreatedCommentResponseDto;
use App\Domain\Models\Comment;
use App\Domain\Repository\CommentRepositoryInterface;
use App\Infrastructure\Service\Comment\CreateCommentService;
use Mockery;
use Tests\TestCase;

class CreateCommentServiceTest extends TestCase
{
    private CreateCommentService $service;
    private CommentRepositoryInterface $commentRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentRepositoryMock = Mockery::mock(CommentRepositoryInterface::class);

        $this->service = new CreateCommentService($this->commentRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_creates_comment_and_returns_correct_dto()
    {
        $commentData = [
            'content' => 'This is a test comment',
            'user_id' => 1,
            'task_id' => 1
        ];

        $comment = new Comment();
        $comment->content = $commentData['content'];
        $comment->user_id = $commentData['user_id'];
        $comment->task_id = $commentData['task_id'];
        $comment->created_at = now()->toDateTimeString();

        $this->commentRepositoryMock->shouldReceive('save')
            ->once()
            ->with($commentData)
            ->andReturn($comment);

        $result = ($this->service)($commentData);

        $this->assertInstanceOf(CreatedCommentResponseDto::class, $result);
        $this->assertEquals($commentData['content'], $result->content);
        $this->assertEquals($commentData['user_id'], $result->author);
        $this->assertEquals($commentData['task_id'], $result->task_id);
        $this->assertEquals($comment->created_at, $result->created_at);
    }
}
