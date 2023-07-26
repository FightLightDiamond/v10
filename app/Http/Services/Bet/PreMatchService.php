<?php

namespace App\Http\Services\Bet;


use App\Const\BetStatusConstant;
use App\Events\BetEvent;
use App\Events\FightEvent;
use App\Events\RewardEvent;
use App\Jobs\RewardJob;
use Exception;
use Illuminate\Support\Facades\Cache;

class PreMatchService
{
    public function __construct(
        protected RoundService $roundService,
    ) {

    }

    /**
     * @throws Exception
     */
    public function execute(): void
    {
        $match = $this->roundService->bet();
        Cache::set('currentMatchId', $match->id, 60 * 3);
        $match->status = BetStatusConstant::BETTING;
        $match->save();
        BetEvent::dispatch($match);
        FightEvent::dispatch($match);
        RewardJob::dispatch($match)->delay(3*60);
    }
}
