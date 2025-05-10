<?php

namespace Tests\Unit\Infrastructure\Service\Task;

use App\Domain\Dto\UpdatedTaskResponseDto;
use App\Domain\Models\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Service\Task\EditTaskService;
use Mockery;
use Tests\TestCase;

class EditTaskServiceTest extends TestCase
{
    private EditTaskService $service;
    private TaskRepositoryInterface $taskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);

        $this->service = new EditTaskService($this->taskRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_it_updates_task_and_returns_correct_dto()
    {
        $taskData = [
            'id' => 1,
            'title' => 'Updated Task',
            'description' => 'Updated Description',
            'task_status_id' => 2
        ];

        $task = new Task();
        $task->id = $taskData['id'];
        $task->title = $taskData['title'];
        $task->description = $taskData['description'];
        $task->task_status_id = $taskData['task_status_id'];

        $this->taskRepositoryMock->shouldReceive('update')
            ->once()
            ->with($taskData)
            ->andReturn($task);

        $result = ($this->service)($taskData);

        $this->assertInstanceOf(UpdatedTaskResponseDto::class, $result);
        $this->assertEquals($taskData['id'], $result->id);
        $this->assertEquals($taskData['title'], $result->title);
        $this->assertEquals($taskData['description'], $result->description);
        $this->assertEquals($taskData['task_status_id'], $result->status);
    }

    public function test_it_handles_repository_exception()
    {
        $invalidTaskData = [
            'id' => 999,
            'title' => '',
            'description' => 'Invalid',
            'task_status_id' => 0
        ];

        $this->taskRepositoryMock->shouldReceive('update')
            ->once()
            ->with($invalidTaskData)
            ->andThrow(new \RuntimeException('Update failed'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Update failed');

        ($this->service)($invalidTaskData);
    }
}
