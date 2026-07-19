<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    public function index()
    {
        $tasks = Task::pending()->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Tasks retrieved successfully',
            'data' => $tasks,
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = $this->taskService->createTask($validated);

        return response()->json([
            'status_code' => 201,
            'message' => 'Task created successfully',
            'data' => $task,
        ], 201);
    }

    public function show(Task $task)
    {
        return response()->json([
            'status_code' => 200,
            'message' => 'Task retrieved successfully',
            'data' => $task,
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        $task = $this->taskService->updateTask($task, $validated);

        return response()->json([
            'status_code' => 200,
            'message' => 'Task updated successfully',
            'data' => $task,
        ]);
    }

    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);

        return response()->json([
            'status_code' => 200,
            'message' => 'Task deleted successfully',
            'data' => null,
        ]);
    }
}