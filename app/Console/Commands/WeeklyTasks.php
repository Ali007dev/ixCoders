<?php

namespace App\Console\Commands;

use App\Jobs\ScheduleTaskJob;
use App\Jobs\WeeklyTasksJob;
use App\Services\ScheduleTaskService;
use Illuminate\Console\Command;

class WeeklyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekly:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Tasks Weekly';

    /**
     * Execute the console command.
     */
    public function handle(ScheduleTaskService $taskService)
    {
        dispatch(new  WeeklyTasksJob());
    }
}
