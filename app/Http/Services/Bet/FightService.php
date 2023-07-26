<?php

namespace App\Http\Services\Bet;

use App\Const\BetStatusConstant;

class FightService
{
    //    public function __construct(protected TheMatchRepository $theMatchRepository)
    //    {
    //
    //    }

    public function execute($math): void
    {
        $math->update(
            [
            'status' => BetStatusConstant::FIGHTING
            ]
        );
    }
}
