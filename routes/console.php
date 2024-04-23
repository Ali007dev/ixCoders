<?php

use App\Console\Commands\AutomaticTask;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('daily:tasks')->daily();
Schedule::command('weekly:tasks')->weekly();
Schedule::command('monthly:tasks')->monthly();
Schedule::command('task:reminder')->everySixHours();

