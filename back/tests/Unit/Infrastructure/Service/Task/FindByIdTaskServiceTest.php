<?php

namespace Tests\Unit\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Service\Task\FindByIdTaskService;
use Mockery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class FindByIdTaskServiceTest extends TestCase
{
    private FindByIdTaskService $service;
    private TaskRepositoryInterface $taskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);

        $this->service = new FindByIdTaskService($this->taskRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_returns_task_when_found()
    {
        $taskId = 1;
        $expectedTask = [
            'id' => $taskId,
            'title' => 'Test Task',
            'description' => 'Test Description',
            'task_status_id' => 1
        ];

        $this->taskRepositoryMock->shouldReceive('findById')
            ->once()
            ->with($taskId)
            ->andReturn($expectedTask);

        $result = ($this->service)($taskId);

        $this->assertIsArray($result);
        $this->assertEquals($expectedTask, $result);
    }

    public function test_it_throws_exception_when_task_not_found()
    {
        $nonExistentTaskId = 999;

        $this->taskRepositoryMock->shouldReceive('findById')
            ->once()
            ->with($nonExistentTaskId)
            ->andReturn([]);

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Task not found');

        ($this->service)($nonExistentTaskId);
    }

    public function test_it_rejects_invalid_task_id()
    {
        $invalidIds = [0, -1];

        foreach ($invalidIds as $invalidId) {
            $this->taskRepositoryMock->shouldNotReceive('findById');

            $this->expectException(\InvalidArgumentException::class);

            $this->taskRepositoryMock->shouldReceive('findById')
                ->once()
                ->with($invalidId);

            ($this->service)($invalidId);
        }
    }

    public function test_it_handles_repository_exception()
    {
        $taskId = 1;

        $this->taskRepositoryMock->shouldReceive('findById')
            ->once()
            ->with($taskId)
            ->andThrow(new \RuntimeException('Database error'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database error');

        ($this->service)($taskId);
    }
}
