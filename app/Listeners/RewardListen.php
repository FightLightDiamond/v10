<?php

namespace App\Listeners;

use App\Const\BetStatusConstant;
use App\Events\RewardEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RewardListen
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
    public function handle(RewardEvent $event): void
    {
        $event->match->update(
            [
            'status' => BetStatusConstant::END
            ]
        );
    }
}
