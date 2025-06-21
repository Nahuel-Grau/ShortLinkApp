<?php

namespace App\Events;

use App\Listeners\ScheduleLinkDeletion;
use App\Models\ShortLink;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TemporaryLinkCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shortLink;
   
    public function __construct(ShortLink $shortLink)
    {
      $this->shortLink = $shortLink;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */



  
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
