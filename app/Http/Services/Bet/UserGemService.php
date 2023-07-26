<?php

namespace App\Http\Services\Bet;

use App\Const\DropConstant;
use App\Const\ItemConstant;
use App\Repositories\BetRepository;
use App\Repositories\TheMatchRepository;
use App\Repositories\UserGemRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class UserGemService
{
    public function __construct(protected UserRepository $userRepository,
        protected TheMatchRepository $theMatchRepository,
        protected UserGemRepository $userGemRepository,
        protected BetRepository $betRepository,
    ) {

    }

    public function drop($userId): void
    {
        if ($this->isDrop()) {
            $gem = $this->userGemRepository->firstOrNew(
                [
                'user_id' => $userId,
                'level' => 1,
                'type' => array_rand(ItemConstant::GEM_TYPES),
                ]
            );

            if ($gem) {
                $gem->update(
                    [
                    'available_num' => DB::raw('available_num + 1')
                    ]
                );
            } else {
                $gem->save();
            }
        }
    }

    private function isDrop(): bool
    {
        return rand(1, 100) < DropConstant::GEM_RATE;
    }
}
