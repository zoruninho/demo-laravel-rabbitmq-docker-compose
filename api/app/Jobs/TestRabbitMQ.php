<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class TestRabbitMQ implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $trackPath,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Log::info('TestRabbitMQ job exécuté !');
    }
}
