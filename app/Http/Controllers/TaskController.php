<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUserRequest;
use App\Services\TaskService;
use App\Services\taskService as ServicesTaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(ServicesTaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function storeTask(TaskRequest $taskRequest)
    {
        $this->taskService->storeTask($taskRequest);

        return ResponseHelper::success('Task added successfully');
    }

    public function assignUsers(TaskUserRequest $taskRequest)
    {
        $this->taskService->assignUsers($taskRequest);

        return ResponseHelper::success('user assigned successfully');
    }


    public function updateUserTasks(TaskUserRequest $taskRequest,$id)
    {
        $this->taskService->updateUserTasks($taskRequest,$id);

        return ResponseHelper::success('task updated successfully');
    }

    public function deleteUserTasks($id)
    {
        $this->taskService->deleteUserTasks($id);

        return ResponseHelper::success('task deleted successfully');
    }

}
