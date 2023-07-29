<?php

namespace App\Listeners;

use App\Events\BetEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BetListen implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'bet.event';
    }

    /**
     * Handle the event.
     */
    public function handle(BetEvent $event): void
    {
        //
    }
}
