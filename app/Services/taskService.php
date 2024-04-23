<?php

namespace App\Services;

use App\Models\ScheduleTask;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Notifications\AssignmentNotification;
use App\Notifications\DeadLineNotification;
use App\Notifications\ReminderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskService
{

    public function __construct()
    {

    }
    //we can use this function to create or update task details
    public function createTaskUser($userId, $taskId, $role, $status, $description, $date)
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
        $user = User::find($userId);
        $user->notify(new AssignmentNotification());
        $user->notify(new ReminderNotification());



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

    public function userTasks()
    {
        $result=User::query()->with('dateTasks')->get()->toArray();
        return $result;
    }

    public function storeScheduleTasks($ScheduleTask)
    {
        $taskId=TaskUser::findOrFail($ScheduleTask->task_id);
        if($taskId){
        $result=ScheduleTask::query()->create([
            'action_id'=>$taskId->id,
            'type'=>$ScheduleTask->type
        ]);}
        return $result;
    }

    public function getAlluserTasks($id)
    {
        $result=User::query()->where('id',$id)->with('inprogresstasks')
        ->with('waitingtasks')
        ->with('donetasks')->
        with('todotasks')->get()->toArray();
        return $result;
    }

    public function myTasks()
    {
        $result=User::query()->where('id',Auth::user()->id)->with('inprogresstasks')
        ->with('waitingtasks')
        ->with('donetasks')->
        with('todotasks')->get()->toArray();
        return $result;
    }



    public function index()
    {
        $response = User::query()
            ->with('inprogresstasks')
            ->with('waitingtasks')
            ->with('donetasks')
            ->with('todotasks')->with('tasks')
            ->get();
            $tasks = $response;
            return view('tasks.index', compact('tasks'));
    }



    public function search($request)
{
    $name = $request->name;
    $search = $request->data;

    if ($name) {
        $nameResults = Task::where('name', 'LIKE', "%$name%")->paginate(10);
        return $nameResults;
    }

    $taskResults = TaskUser::whereAny(
        [
            'description',
            'status'
        ],
        'LIKE',
        "%$search%"
    )->paginate(10);

    return $taskResults;
}

public function taskDetails($id)
{
    $result=Task::query()->where('id',$id)->with('comments')->get()->toArray();
    return $result;
}


}
