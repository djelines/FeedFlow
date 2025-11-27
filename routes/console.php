<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Runs the survey report command 
Schedule::command('app:send-survey-daily-reports')->everyFifteenMinutes();
Schedule::command('app:check-for-survey-to-close')->everyFifteenMinutes();