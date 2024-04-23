<?php

namespace App\Jobs;

use App\Models\ScheduleTask;
use App\Models\TaskUser;
use App\Services\ScheduleTaskService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DailyTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */


    /**
     * Execute the job.
     */
    public function handle()
    {
        app(ScheduleTaskService::class)->scheduleTask('daily');
    }

}
