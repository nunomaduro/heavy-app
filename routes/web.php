<?php

use App\Jobs\ProcessRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'php_version' => phpversion(),
        'requests_count' => Cache::get('requests_count'),
        'jobs_count' => Cache::get('jobs_count'),
    ];
});

Route::get('/loop', function () {
    DB::table('requests')->insert([
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    if (! Cache::has('requests_count')) {
        Cache::put('requests_count', 0);
    }

    Cache::increment('requests_count');

    ProcessRequest::dispatch();

    return [
        'info' => 'Request processed. Loop initiated.',
        'requests_count' => Cache::get('requests_count'),
        'jobs_count' => Cache::get('jobs_count'),
    ];
});

Route::get('/loop_shutdown', function () {
    Artisan::call('queue:clear');

    Cache::forget('jobs_count');
    Cache::forget('requests_count');

    return 'Cleared the queue';
});