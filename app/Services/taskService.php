<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskService
{


    //we can use this function to create or update task details
    protected function createTaskUser($userId, $taskId, $role, $status, $description, $date)
    {
        TaskUser::updateOrCreate(
            [
                'user_id' => $userId,
                'task_id' => $taskId,
            ],
            [
                'role' => $role,
                'status' => $status,
                'description' => $description,
                'date' => $date,
            ]
        );
    }


    public function storeTask($taskRequest)
    {
        $file = $taskRequest->file ? upload($taskRequest->file, 'task/files') : null;
        $task = Task::create([
            'name' => $taskRequest->name,
            'file' => $file,
            'priority' => $taskRequest->priority
        ]);

        $this->createTaskUser(Auth::user()->id, $task->id, 'admin', null, null, null);

        return $task;
    }

    public function assignUsers($taskUserRequest)
    {
        $userId = $taskUserRequest->user_id;
        $taskId = $taskUserRequest->task_id;
        $role = $taskUserRequest->role;
        $status = $taskUserRequest->status;
        $description = $taskUserRequest->description;
        $date = $taskUserRequest->date;
        $this->createTaskUser($userId, $taskId, $role, $status, $description, $date);
    }


    public function updateUserTasks($taskUserRequest, $id)
    {
        $result = TaskUser::query()->findOrFail($id);
        $result->update([
            'role' => $taskUserRequest->role ?: $result->role,
            'description' => $taskUserRequest->description ?:  $result->description,
            'status' => $taskUserRequest->status ?: $result->status,
            'date' => $taskUserRequest->date ?: $result->date,
        ]);
    }

    public function deleteUserTasks($id)
    {
        $result = TaskUser::query()->findOrFail($id);
        $result ->delete();
    }
}
