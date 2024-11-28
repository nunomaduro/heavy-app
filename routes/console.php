<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('every-minute', function () {
    $this->comment('Running "every-minute" schedule task. Current time: ' . now());
})->purpose('Display an inspiring quote')->everyMinute();

Artisan::command('every-minute-in-background', function () {
    $this->comment('Running "every-minute-in-background" scheduled task. Current time: ' . now());
})->purpose('Display an inspiring quote')->everyMinute()->runInBackground();

Artisan::command('every-minute-in-one-server', function () {
    $this->comment('[onOneServer] Running "every-minute" schedule task. Current time: ' . now());
})->purpose('Display an inspiring quote')->everyMinute()->onOneServer();

Artisan::command('every-minute-in-background-in-one-server', function () {
    $this->comment('[onOneServer] Running "every-minute-in-background" scheduled task. Current time: ' . now());
})->purpose('Display an inspiring quote')->everyMinute()->runInBackground()->onOneServer();
