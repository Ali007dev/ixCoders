<?php

namespace App\Services;

use App\Models\ScheduleTask;
use App\Models\TaskUser;
use App\Models\User;
use App\Notifications\DeadLineNotification;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;

class ScheduleTaskService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function scheduleTask($type)
    {
        $scheduleTaskIds = ScheduleTask::query()
        ->where('type',$type)->get();

        foreach ($scheduleTaskIds as $scheduleTaskId) {
            $task = TaskUser::query();
            $result = $task->findOrFail($scheduleTaskId->action_id);
            $task->create([
                'user_id' => $result->user_id,
                'task_id' => $result->task_id,
                'role' => $result->role,
                'status' => $result->status,
                'date' => Carbon::now(),
            ]);
        }
    }

//Send Notification Before 1 Day Of DeadLine//
    public function reminderDeadLine()  {

        $tasks = TaskUser::where('status', '!=', 'done')->get();
        foreach ($tasks as $task) {
            $deadline = $task->deadline;
            $remainingDays = Carbon::parse($deadline)->diffInDays(now(), false);
            if ($remainingDays === 1) {
                $userId = $task->user_id;
                $user = User::find($userId);
                $user->notify(new ReminderNotification());
            }
        }


}
}
