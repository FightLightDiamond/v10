<?php

namespace App\Http\Services;

use App\Models\Hero;
use App\Models\TheMatch;
use App\Repositories\HeroRepository;

class RoundService
{
    protected $home;
    protected $away;
    protected int $turn_number = 1;
    protected TheMatch $match;
    protected array $hero_info;
    protected array $turns;

    public function __construct(protected HeroRepository $heroRepository)
    {

    }

    public function bet()
    {
        $heroes = $this->heroRepository->getPairHeroes();
        $one = $heroes[0];
        $two = $heroes[1];
    }

    public function preBet($home, $away)
    {
        $this->turn_number = 1;
        $this->home = (new HeroLogService())->setCurrent($home);
        $this->away = (new HeroLogService())->setCurrent($away);
        $this->turns = [];
        $this->hero_info = [$this->home, $this->away];
    }
}
