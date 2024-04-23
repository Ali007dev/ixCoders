<?php

namespace App\Jobs;

use App\Services\ScheduleTaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeeklyTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $taskService;



    /**
     * Execute the job.
     */
    public function handle()
    {
        app(ScheduleTaskService::class)->scheduleTask('weekly');

    }
}
