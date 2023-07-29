<?php

namespace App\Http\Services;

use App\Repositories\HeroRepository;

class HeroService
{
    public function __construct(protected HeroRepository $heroRepository)
    {

    }
}
