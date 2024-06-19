<?php

namespace App\Services;

use App\DTOs\TaskDto;
use App\DTOs\TaskListRequestDto;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository
    ){
    }

    /* @return Collection<Task> */
    public function getAllTasks(TaskListRequestDto $dto): Collection
    {
        return $this->taskRepository->getAllTasks($dto);
    }

    public function createTask(TaskDto $taskDto): Task
    {
        $task = $this->taskRepository->create($taskDto);

        return $this->getTaskById($task->id);
    }

    public function getTaskById(int $id): Task
    {
        return $this->taskRepository->getTaskById($id);
    }

    public function updateTask(TaskDto $dto): Task
    {
        $task = $this->taskRepository->getTaskById($dto->id);

        $task->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'status' => $dto->status,
            'category_id' => $dto->category_id,
            'user_id' => $dto->user_id,
        ]);

        return $this->getTaskById($task->id);
    }
}
