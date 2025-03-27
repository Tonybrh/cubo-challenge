<?php

namespace Tests\Unit\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Service\Task\DeleteTaskService;
use Mockery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class DeleteTaskServiceTest extends TestCase
{
    private DeleteTaskService $service;
    private TaskRepositoryInterface $taskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);

        $this->service = new DeleteTaskService($this->taskRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_deletes_task_successfully()
    {
        $taskId = 123;

        $this->taskRepositoryMock->shouldReceive('deleteTaskAndComments')
            ->once()
            ->with($taskId)
            ->andReturnNull();

        ($this->service)($taskId);

        $this->assertTrue(true);
    }

    public function test_it_handles_repository_exception()
    {
        $taskId = 456;

        $this->taskRepositoryMock->shouldReceive('deleteTaskAndComments')
            ->once()
            ->with($taskId)
            ->andThrow(new \RuntimeException('Database error'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database error');

        ($this->service)($taskId);
    }

    public function test_it_rejects_invalid_task_id()
    {
        $invalidTaskId = 0;

        $this->taskRepositoryMock->shouldReceive('deleteTaskAndComments')
            ->once()
            ->with($invalidTaskId)
            ->andThrow(new NotFoundHttpException('Task not found'));

        $this->expectException(NotFoundHttpException::class);

        ($this->service)($invalidTaskId);
    }
}
