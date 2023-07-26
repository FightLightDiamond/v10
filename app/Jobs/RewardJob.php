<?php

namespace App\Jobs;

use App\Http\Services\Bet\RewardService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RewardJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $match)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(RewardService $rewardService): void
    {
        $rewardService->execute($this->match);
    }
}
