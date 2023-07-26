<?php

namespace App\Console\Commands;

use App\Http\Services\Bet\RoundService;
use Illuminate\Console\Command;

class PreMatchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pre-match';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(RoundService $roundService)
    {
        $roundService->bet();
    }
}
