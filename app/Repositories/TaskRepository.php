<?php

namespace App\Repositories;

use App\DTOs\TaskDto;
use App\DTOs\TaskListRequestDto;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    /**
     * @return Collection<Task>
     */
    public function getAllTasks(TaskListRequestDto $dto): Collection
    {
        $query = Task::with('category');

        if ($dto->status) {
            $query->where('status', $dto->status);
        }

        if ($dto->category) {
            $query->whereHas('category', function ($query) use ($dto) {
                $query->where('name', $dto->category);
            });
        }

        if ($dto->priority) {
            $query->where('priority', $dto->priority);
        }

        return $query->get();
    }

    public function create(TaskDto $task)
    {
        return Task::create([
                'title' => $task->title,
                'description' => $task->description,
                'category_id' => $task->category_id,
                'status' => $task->status,
                'user_id' => $task->user_id,
            ]
        );
    }

    public function getTaskById(int $id): Task
    {
        return Task::with('category')
            ->findOrFail($id);
    }
}
