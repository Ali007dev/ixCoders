<?php

namespace App\Services;
use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;

 class TaskService
{



    protected function createTaskUser($userId,$taskId,$role,$status,$description,$date)
    {
        TaskUser::create([
            'user_id' =>$userId,
            'task_id' => $taskId,
            'role' => $role,
            'status' => $status,
            'description' => $description,
            'date' => $date,
        ]);
    }




    public function storeTask($taskRequest)
    {
        $file = $taskRequest->file ? upload($taskRequest->file, 'task/files') : null;
        $task = Task::create([
            'name' => $taskRequest->name,
            'file'=>$file,
            'priority' => $taskRequest->priority
        ]);

        $this->createTaskUser(Auth::user()->id,$task->id,'admin',null,null,null);

        return $task;
    }

    public function assignUsers($taskUserRequest)
    {
    $userIds = $taskUserRequest->user_id;

    $taskId = $taskUserRequest->task_id;

    foreach ($userIds as $userId) {
        $this->createTaskUser(
            $userId,
            $taskId,
        $taskUserRequest->role,
        $taskUserRequest->status,
        $taskUserRequest->description,
        $taskUserRequest->date);

    }
}
}
