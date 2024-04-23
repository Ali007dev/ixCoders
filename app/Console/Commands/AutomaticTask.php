<?php

namespace App\Console\Commands;

use App\Http\Requests\TaskRequest;
use App\Jobs\DailyTasksJob;
use App\Jobs\ScheduleTaskJob;
use App\Models\ScheduleTask;
use App\Models\TaskUser;
use App\Services\ScheduleTaskService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class AutomaticTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $Schedule;


    /**
     * Execute the console command.
     */
   public function handle()
{
  dispatch(new DailyTasksJob());
}
}
