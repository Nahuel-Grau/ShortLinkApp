<?php

namespace App\Jobs;

use App\Models\Link;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Response;

class DeleteLink implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Link $link)
    {
        //
    }

    /**
     * Execute the job.
     */
 public function handle(): void
{
    $this->link->delete();
     
}
}
