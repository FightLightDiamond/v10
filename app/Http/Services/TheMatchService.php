<?php

namespace App\Http\Services;

use App\Const\BetStatusConstant;
use App\Repositories\TheMatchRepository;
use Illuminate\Support\Facades\Cache;

class TheMatchService
{
    public function __construct(protected TheMatchRepository $theMatchRepository)
    {
    }

    public function paginate()
    {
        return $this->theMatchRepository->paginate();
    }

    public function getCurrent()
    {
        $currentMatchId = Cache::get('currentMatchId') ?? 1;
        $match = $this->theMatchRepository->find($currentMatchId);

        if (!$match) {
            return $match;
        }

        switch ($match->status) {
            case BetStatusConstant::BETTING:
            case BetStatusConstant::PENDING:
                return [
                    'id' => $match->id,
                    'hero_info' =>$match->hero_info,
                    'status'  => $match->status,
                    'start_time'  => $match->start_time,
                ];
            case BetStatusConstant::FIGHTING:
                return $match;
        }
    }
}
