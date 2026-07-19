<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskWebController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    public function index(Request $request)
{
    $filter = $request->get('filter', 'all');

    $tasks = Task::with('user')
        ->when($filter === 'pending', fn($q) => $q->pending())
        ->when($filter === 'completed', fn($q) => $q->where('status', 'completed'))
        ->latest()
        ->paginate(10);

    $userCount = User::count();

    $pendingCount = Task::pending()->count();
    $completedCount = Task::where('status', 'completed')->count();

    return view('tasks.index', compact(
        'tasks',
        'filter',
        'pendingCount',
        'completedCount',
        'userCount'
    ));
}


   public function create()
{
    $users = User::select('id', 'name', 'email')->get();

    return view('tasks.create', compact('users'));
}


    public function store(StoreTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'تم إنشاء المهمة بنجاح!');
    }


    public function show(Task $task)
    {
        $task->load('user');

        return view('tasks.show', compact('task'));
    }


   public function edit(Task $task)
{
    $users = User::select('id', 'name', 'email')->get();

    return view('tasks.edit', compact('task', 'users'));
}


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->taskService->updateTask($task, $request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'تم تحديث المهمة بنجاح!');
    }


    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')
            ->with('success', 'تم حذف المهمة بنجاح!');
    }
}