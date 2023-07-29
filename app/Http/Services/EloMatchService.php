<?php

namespace App\Http\Services;

use App\Repositories\EloMatchRepository;

class EloMatchService
{
    public function __construct(EloMatchRepository $eloMatchRepository)
    {
    }
}
