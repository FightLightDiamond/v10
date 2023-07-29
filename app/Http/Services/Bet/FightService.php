<?php

namespace App\Http\Services\Bet;

use App\Const\BetStatusConstant;
use App\Repositories\TheMatchRepository;

class FightService
{
    public function __construct(protected TheMatchRepository $theMatchRepository)
    {

    }

    public function execute($mathId): void
    {
        $this->theMatchRepository->update(
            [
                'status' => BetStatusConstant::FIGHTING
            ], $mathId
        );
    }
}
