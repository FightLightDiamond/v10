<?php

namespace App\Http\Services;

use App\Repositories\TheMatchRepository;

class TheMatchService
{
    public function __construct(protected TheMatchRepository $theMatchRepository) {}

    public function paginate()
    {
        return $this->theMatchRepository->paginate();
    }

    public function getCurrent()
    {

    }
}
