<?php

namespace App\Console\Commands;

use App\Jobs\MonthlyTasksJob;
use App\Jobs\ScheduleTaskJob;
use App\Services\ScheduleTaskService;
use Illuminate\Console\Command;

class MonthlyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Tasks Monthly';

    /**
     * Execute the console command.
     */
    public function handle(ScheduleTaskService $taskService)
    {
        dispatch(new  MonthlyTasksJob());
    }
}
