<?php

namespace Tests\Unit\Infrastructure\Service\Task;

use App\Domain\Models\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Service\Task\GetTaskByUserGetService;
use Mockery;
use Tests\TestCase;

class GetTaskByUserGetServiceTest extends TestCase
{
    private GetTaskByUserGetService $service;
    private TaskRepositoryInterface $taskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);

        $this->service = new GetTaskByUserGetService($this->taskRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_returns_tasks_for_valid_user()
    {
        $userId = 1;
        $expectedTasks = [
            new Task(['title' => 'Task 1', 'user_id' => $userId]),
            new Task(['title' => 'Task 2', 'user_id' => $userId])
        ];

        $this->taskRepositoryMock->shouldReceive('getTaskByUser')
            ->once()
            ->with($userId)
            ->andReturn($expectedTasks);

        $result = ($this->service)($userId);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Task::class, $result);

        foreach ($result as $task) {
            $this->assertEquals($userId, $task->user_id);
        }
    }

    public function test_it_returns_empty_array_when_no_tasks_found()
    {
        $userId = 2;

        $this->taskRepositoryMock->shouldReceive('getTaskByUser')
            ->once()
            ->with($userId)
            ->andReturn([]);

        $result = ($this->service)($userId);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function test_it_rejects_invalid_user_id()
    {
        $invalidUserIds = [0, -1];

        foreach ($invalidUserIds as $invalidUserId) {

            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage('User ID must be positive');

            ($this->service)($invalidUserId);
        }
    }

    public function test_it_handles_repository_exception()
    {
        $userId = 3;

        $this->taskRepositoryMock->shouldReceive('getTaskByUser')
            ->once()
            ->with($userId)
            ->andThrow(new \RuntimeException('Database error'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database error');

        ($this->service)($userId);
    }
}
