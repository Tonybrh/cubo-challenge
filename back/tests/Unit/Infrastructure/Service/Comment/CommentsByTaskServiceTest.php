<?php

namespace Tests\Unit\Infrastructure\Service\Comment;

use App\Domain\Models\Comment;
use App\Domain\Repository\CommentRepositoryInterface;
use App\Infrastructure\Service\Comment\CommentsByTaskService;
use Mockery;
use Tests\TestCase;

class CommentsByTaskServiceTest extends TestCase
{
    private CommentsByTaskService $service;
    private CommentRepositoryInterface $commentRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentRepositoryMock = Mockery::mock(CommentRepositoryInterface::class);

        $this->service = new CommentsByTaskService($this->commentRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_returns_comments_for_valid_task()
    {
        $taskId = 1;
        $expectedComments = [
            new Comment(['content' => 'First comment', 'task_id' => $taskId]),
            new Comment(['content' => 'Second comment', 'task_id' => $taskId])
        ];

        $this->commentRepositoryMock->shouldReceive('findByTaskId')
            ->once()
            ->with($taskId)
            ->andReturn($expectedComments);

        $result = ($this->service)($taskId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Comment::class, $result);

        foreach ($result as $comment) {
            $this->assertEquals($taskId, $comment->task_id);
        }
    }

    public function test_it_returns_empty_array_when_no_comments_found()
    {
        $taskId = 2;

        $this->commentRepositoryMock->shouldReceive('findByTaskId')
            ->once()
            ->with($taskId)
            ->andReturn([]);

        $result = ($this->service)($taskId);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function test_it_rejects_invalid_task_id()
    {
        $invalidTaskIds = [0, -1];

        foreach ($invalidTaskIds as $invalidTaskId) {
            $this->commentRepositoryMock->shouldNotReceive('findByTaskId');

            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage('Task ID must be positive');

            ($this->service)($invalidTaskId);
        }
    }

    public function test_it_handles_repository_exception()
    {
        $taskId = 3;

        $this->commentRepositoryMock->shouldReceive('findByTaskId')
            ->once()
            ->with($taskId)
            ->andThrow(new \RuntimeException('Database error'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database error');

        ($this->service)($taskId);
    }
}
