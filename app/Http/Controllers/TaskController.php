<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskListRequest;
use App\Http\Requests\TaskUpsertRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService)
    {
    }

    public function index(TaskListRequest $request): AnonymousResourceCollection
    {
        $tasks = $this->taskService->getAllTasks($request->dto());

        return TaskResource::collection($tasks);
    }

    public function store(TaskUpsertRequest $request): JsonResponse
    {
        $task = $this->taskService->createTask($request->dto());

        return TaskResource::make($task)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Task $task)
    {
        $task = $this->taskService->getTaskById($task->id);

        return TaskResource::make($task);
    }

    public function update(TaskUpsertRequest $request, Task $task)
    {
        $task = $this->taskService->updateTask($request->dto());

        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
