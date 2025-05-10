<?php

namespace Tests\Unit\Infrastructure\Service\Task;

use App\Domain\Models\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Service\Task\TaskByStatusService;
use Mockery;
use Tests\TestCase;

class TaskByStatusServiceTest extends TestCase
{
    private TaskByStatusService $service;
    private TaskRepositoryInterface $taskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);

        $this->service = new TaskByStatusService($this->taskRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_returns_tasks_by_status_for_user()
    {
        $statusId = 1;
        $userId = 10;

        $expectedTasks = [
            new Task(['title' => 'Task 1', 'task_status_id' => $statusId, 'user_id' => $userId]),
            new Task(['title' => 'Task 2', 'task_status_id' => $statusId, 'user_id' => $userId])
        ];

        $this->taskRepositoryMock->shouldReceive('getTaskByStatus')
            ->once()
            ->with($statusId, $userId)
            ->andReturn($expectedTasks);

        $result = ($this->service)($statusId, $userId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Task::class, $result);

        foreach ($result as $task) {
            $this->assertEquals($statusId, $task->task_status_id);
            $this->assertEquals($userId, $task->user_id);
        }
    }

    public function test_it_returns_empty_array_when_no_tasks_found()
    {
        $statusId = 2;
        $userId = 20;

        $this->taskRepositoryMock->shouldReceive('getTaskByStatus')
            ->once()
            ->with($statusId, $userId)
            ->andReturn([]);

        $result = ($this->service)($statusId, $userId);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function test_it_handles_repository_exception()
    {
        $statusId = 3;
        $userId = 30;

        $this->taskRepositoryMock->shouldReceive('getTaskByStatus')
            ->once()
            ->with($statusId, $userId)
            ->andThrow(new \RuntimeException('Database error'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database error');

        ($this->service)($statusId, $userId);
    }

    public function test_it_rejects_invalid_status_id()
    {
        $invalidStatusId = 0;
        $userId = 40;

        $this->taskRepositoryMock->shouldNotReceive('getTaskByStatus');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Status ID must be positive');

        ($this->service)($invalidStatusId, $userId);
    }

    public function test_it_rejects_invalid_user_id()
    {
        $statusId = 1;
        $invalidUserId = 0;

        $this->taskRepositoryMock->shouldNotReceive('getTaskByStatus');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('User ID must be positive');

        ($this->service)($statusId, $invalidUserId);
    }
}
