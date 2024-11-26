<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessRequest implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = config('app.url') . '/loop';

        Http::get($url);

        if (! Cache::has('jobs_count')) {
            Cache::put('jobs_count', 0);
        }

        Cache::increment('jobs_count');
    }
}
