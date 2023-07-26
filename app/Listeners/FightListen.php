<?php

namespace App\Listeners;

use App\Const\BetStatusConstant;
use App\Events\FightEvent;
use App\Http\Services\Bet\FightService;

class FightListen
{
    /**
     * Create the event listener.
     */
    public function __construct(protected FightService $fightService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FightEvent $event): void
    {
//        $event->match->update(
//            [
//            'status' => BetStatusConstant::FIGHTING
//            ]
//        );
//       $this->fightService->execute($event->id);
    }
}
