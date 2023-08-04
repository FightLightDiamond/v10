<?php

namespace App\Http\Services\Bet;

use App\Const\BetStatusConstant;
use App\Events\RewardEvent;
use App\Repositories\BetRepository;
use App\Repositories\TheMatchRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class RewardService
{
    public function __construct(protected UserRepository $userRepository,
        protected TheMatchRepository $theMatchRepository,
        protected UserGemService $userGemService,
        protected BetRepository $betRepository,
    ) {

    }
    public function execute($match): void
    {
        $winner = $match->winner;

        $bets = $this->betRepository->findWhere(
            [
            'match_id' =>$match->id,
            'hero_id' => $winner,
            ],
            [
            'user_id', 'balance', 'match_id', 'hero_id'
            ]
        );

        foreach ($bets as $bet) {
            $this->userRepository->update(
                [
                'balance' => DB::raw('balance + ' . ($bet->balance * 2)),
                ], $bet->user_id
            );

            $this->userGemService->drop($bet->user_id);
        }

        $match->update(
            [
            'status' => BetStatusConstant::END
            ]
        );

        RewardEvent::dispatch($bets);
    }
}
