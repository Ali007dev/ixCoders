<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\ScheduleTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUserRequest;
use App\Models\User;
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


    public function updateUserTasks(TaskUserRequest $taskRequest, $id)
    {
        $this->taskService->updateUserTasks($taskRequest, $id);

        return ResponseHelper::success('task updated successfully');
    }

    public function deleteUserTasks($id)
    {
        $this->taskService->deleteUserTasks($id);

        return ResponseHelper::success('task deleted successfully');
    }

    public function userTasks()
    {
        $result = $this->taskService->userTasks();

        return ResponseHelper::success($result, null, 'user tasks', 200);
    }

    public function storeScheduleTasks(ScheduleTaskRequest $request)
    {
        $result = $this->taskService->storeScheduleTasks($request);

        return ResponseHelper::success($result, null, 'user tasks', 200);
    }

    public function getAlluserTasks(ScheduleTaskRequest $request, $id)
    {
        $result = $this->taskService->getAlluserTasks($id);

        return ResponseHelper::success($result, null, 'user tasks', 200);
    }


    //view   show  all tasks
    public function index()
    {
        return  $this->taskService->index();
    }

    public function search(Request $request)
    {
        $result =  $this->taskService->search($request);

        return ResponseHelper::success($result, null, 'result', 200);
    }

    public function myTasks()
    {
        $result = $this->taskService->myTasks();

        return ResponseHelper::success($result, null, 'my tasks', 200);
    }

    public function taskDetails($id)
    {
        $result = $this->taskService->taskDetails($id);

        return ResponseHelper::success($result, null, 'task details', 200);
    }
}
