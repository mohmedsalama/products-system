<?php

namespace App\Services;
use App\Models\User;
use App\Notifications\TaskCreatedNotification;
use App\Notifications\TaskUpdatedNotification;
use App\Models\Task;

class TaskService
{
   public function createTask(array $data): Task
{
    $task = Task::create($data);

    $user = User::find($data['user_id']);

    if ($user) {
        $user->notify(new TaskCreatedNotification($task));
    }

    return $task;
}

   public function updateTask(Task $task, array $data): Task
{
    $task->update($data);

    $user = User::find($task->user_id);

    if ($user) {
        $user->notify(new TaskUpdatedNotification($task));
    }

    return $task;
}

    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }
}