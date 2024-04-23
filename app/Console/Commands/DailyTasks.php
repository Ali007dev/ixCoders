<?php

namespace App\Console\Commands;

use App\Jobs\DailyTasksJob;
use App\Jobs\ScheduleTaskJob;
use Illuminate\Console\Command;

class DailyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Tasks Daily';

    /**
     * Execute the console command.
     */
     public function handle( )
     {
        dispatch(new DailyTasksJob());
     }
}
