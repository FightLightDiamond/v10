<?php

namespace App\Http\Services\System;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class BeginService
{
    const RATION = 3;
    public function base($userId = '1', $matchId = '1'): void
    {
        Cache::tags($matchId)->forever("coin{$userId}", 10);
        Cache::tags($matchId)->forever("hero{$userId}", [
            'hp' => 1000, 'atk' => 100, 'crit' => 20, 'crit_dmg' => 200
        ]);
    }

    //public function up();
}
