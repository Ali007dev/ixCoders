<?php

namespace App\Jobs;

use App\Models\ScheduleTask;
use App\Models\TaskUser;
use App\Services\ScheduleTaskService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduleTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $taskService;

    // public function __construct(ScheduleTaskService $taskService)
    // {
    //     $this->taskService = $taskService;
    // }

    /**
     * Execute the job.
     */
    public function handle()
    {
      //   $this->taskService->scheduleTask('daily');

    }
}
