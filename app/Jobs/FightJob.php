<?php

namespace App\Jobs;

use App\Const\BetStatusConstant;
use App\Events\FightEvent;
use App\Http\Services\Bet\FightService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FightJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $match;

    /**
     * Create a new job instance.
     */
    public function __construct($match)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(FightService $fightService): void
    {
        $this->match->update(
            [
                'status' => BetStatusConstant::FIGHTING
            ]
        );
        //        $fightService->execute($this->match->id);
        FightEvent::dispatch($this->match);
    }
}
