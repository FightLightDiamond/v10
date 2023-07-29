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


    /**
     * Create a new job instance.
     */
    public function __construct(public $match)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->match->update(
            [
                'status' => BetStatusConstant::FIGHTING
            ]
        );
        FightEvent::dispatch($this->match);
    }
}
