<?php

namespace Tests\Unit\Infrastructure\Service\Task;

use App\Domain\Dto\CreatedTaskResponseDto;
use App\Domain\Models\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Service\Task\CreateTaskService;
use Mockery;
use Tests\TestCase;

class CreateTaskServiceTest extends TestCase
{
    private CreateTaskService $service;
    private TaskRepositoryInterface $taskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);

        $this->service = new CreateTaskService($this->taskRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_creates_task_and_returns_correct_dto()
    {
        $taskData = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'task_status_id' => 1
        ];

        $task = new Task();
        $task->title = $taskData['title'];
        $task->description = $taskData['description'];
        $task->task_status_id = $taskData['task_status_id'];

        $this->taskRepositoryMock->shouldReceive('save')
            ->with($taskData)
            ->andReturn($task);

        $result = ($this->service)($taskData);

        $this->assertInstanceOf(CreatedTaskResponseDto::class, $result);
        $this->assertSame($taskData['title'], $result->title);
        $this->assertSame($taskData['description'], $result->description);
        $this->assertSame($taskData['task_status_id'], $result->status);
    }

    public function test_it_handles_repository_exception()
    {
        $taskData = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'task_status_id' => 1
        ];

        $this->taskRepositoryMock->shouldReceive('save')
            ->once()
            ->with($taskData)
            ->andThrow(new \RuntimeException('Database error'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Database error');

        ($this->service)($taskData);
    }
}
