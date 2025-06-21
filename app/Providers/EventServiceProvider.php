<?php

namespace App\Providers;

use App\Events\TemporaryLinkCreated;
use App\Listeners\ScheduleLinkDeletion;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
       TemporaryLinkCreated::class => [
        ScheduleLinkDeletion::class,
       ],
    ];

    public function shouldDiscoverEvents(): bool
{
    return true;
}

    public function boot(): void
    {
       
    }
}
