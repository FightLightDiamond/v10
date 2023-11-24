<?php

namespace App\Http\Services\Bet;


use App\Const\BetStatusConstant;
use App\Events\BetEvent;
use App\Jobs\FightJob;
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
        $match->status = BetStatusConstant::BETTING;
        $match->save();

        Cache::set('currentMatchId', $match->id, 60 * 3);

        BetEvent::dispatch($match);
        FightJob::dispatch($match)->delay(60);
        RewardJob::dispatch($match)->delay(180);
    }
}
