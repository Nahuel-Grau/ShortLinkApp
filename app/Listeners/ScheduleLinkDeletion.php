<?php

namespace App\Listeners;

use App\Events\TemporaryLinkCreated;
use App\Jobs\DeleteLink;
use App\Models\ShortLink;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ScheduleLinkDeletion implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TemporaryLinkCreated $event): void
    {
            $link = $event->link;
            DeleteLink::dispatch($link)->delay(now()->addSecond(30));
            
        
        
    }
}
