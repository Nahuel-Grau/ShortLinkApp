<?php

namespace App\Listeners;

use App\Events\TemporaryLinkCreated;
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
        if(is_null($event->shortLink->id_usuario)){
            TemporaryLinkCreated::dispatch($event->shortLink)->delay(now()->addMinute(1));
        }
    }
}
