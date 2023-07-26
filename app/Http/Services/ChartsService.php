<?php

namespace App\Http\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;

class ChartsService
{
    public function __construct(protected UserRepository $userRepository)
    {

    }

    public function getChartsGold()
    {
        return Cache::remember(
            'getChartsGold', 10, function () {
                return $this->userRepository->getOrderLimit(['balance', 'DESC'], 20);
            }
        );
    }
}
