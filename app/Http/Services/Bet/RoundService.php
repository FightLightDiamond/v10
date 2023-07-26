<?php

namespace App\Http\Services\Bet;


use App\Const\BetStatusConstant;
use App\Http\Services\HeroLogService;
use App\Http\Services\SkillFactory;
use App\Models\TheMatch;
use App\Repositories\HeroRepository;
use App\Repositories\TheMatchRepository;
use Exception;

class RoundService
{
    protected $home;
    protected $away;
    protected int $turn_number = 1;
    protected TheMatch $match;
    protected array $hero_info;
    protected array $turns;

    public function __construct(protected HeroRepository $heroRepository, protected TheMatchRepository $theMatchRepository)
    {

    }

    /**
     * @throws Exception
     */
    public function bet()
    {
        $heroes = $this->heroRepository->getPairHeroes();
        $home = $heroes[0];
        $away = $heroes[1];
        return $this->preBet($home, $away)
            ->execute();
    }

    public function preBet($home, $away): static
    {
        $this->turn_number = 1;
        $this->home = (new HeroLogService())->setCurrent($home);
        $this->away = (new HeroLogService())->setCurrent($away);
        $this->turns = [];
        $this->hero_info = [$this->home, $this->away];

        return $this;
    }

    /**
     * @throws Exception
     */
    public function execute()
    {
        $turn_number = 0;

        while (
            $this->home->current_hp > 0 &&
            $this->away->current_hp > 0 &&
            $turn_number < 20
        ) {
            $this->home->turn_number = $turn_number;
            $this->away->turn_number = $turn_number;

            if ($this->home->current_spd > $this->away->current_spd) {
                $this->attack($this->home, $this->away);
            } else {
                $this->attack($this->away, $this->home);
            }

            $turn_number++;
        }

        $dataMatchUpdate = [
            'hero_info' => $this->hero_info,
            'turn_number' => $this->turn_number,
            'winner' => $this->home->current_hp > $this->away->current_hp ? $this->home->id : $this->away->id,
            'loser' => $this->home->current_hp > $this->away->current_hp ? $this->away->id : $this->home->id,
            'turns' => $this->turns,
            'start_time' => strval(time()),
            'status' => BetStatusConstant::BETTING,
        ];

        // Assuming that you have your own implementation of matchRepository->save()
        $match = $this->theMatchRepository->create($dataMatchUpdate);

        // Uncomment this block if you need to create and save preAutoBetData as well
        // $preAutoBetData = [
        //     'match_id' => $match->id,
        //     'rival_pair' => $this->home->id < $this->away->id
        //         ? $this->home->id . '|' . $this->away->id
        //         : $this->away->id . '|' . $this->home->id,
        // ];

        // Clear the winner, loser, and turns properties to the default values
        $match->winner = 0;
        $match->loser = 0;
        $match->turns = [];

        return $match;
    }

    /**
     * @throws Exception
     */
    public function attack($home, $away): void
    {
        // Turn 1
        $home->is_atk = true;
        $away->is_atk = false;
        $this->turnAtk($home, $away);

        if ($home->current_hp <= 0 || $away->current_hp <= 0) {
            return;
        }

        // Turn 2
        $away->is_atk = true;
        $home->is_atk = false;
        $this->turnAtk($away, $home);

        return;
    }

    /**
     * @throws Exception
     */
    function turnAtk($home, $away): void
    {
        // Reset
        $home->is_active_skill = false;
        $home->take_skill_dmg = 0;
        $home->take_dmg = 0;

        $away->is_active_skill = false;
        $away->take_dmg = 0;
        $away->take_skill_dmg = 0;

        // Skill
        [$home, $away] = SkillFactory::create($home, $away);

        // Random xac suat ne'
        $dodgeProbability = rand(1, 100);

        if ($dodgeProbability > $away->dodge) {
            // Dame
            $dame = $home->current_atk;
            $dame -= $away->current_def;

            // Random xac suat crit
            $bProbability = rand(1, 100);

            if ($bProbability <= $home->current_crit_rate) {
                $dame = round(($dame * $home->current_crit_dmg) / 100);
                $home->is_crit = true;
            }

            // Neu dame < 0 thi mac dinh doi phuong mat 1 HP
            if ($dame < 0) {
                $dame = 1;
            }

            // Neu tuong la` Nezha
            $ratioHp = $home->current_hp / $home->hp;
            if ($home->name == 'Nezha') {
                if ($ratioHp <= 0.8) {
                    // Hoi HP tuong duong 50% dame
                    $home->current_hp += round($dame * 0.5);
                }
                if ($home->is_active_skill && $ratioHp <= 0.5) {
                    // Gay them dame = 2 * dame
                    $skillDame = $dame * 2;
                    $away->current_hp -= $skillDame;
                    $away->take_skill_dmg = $skillDame;
                }
            }

            $away->take_dmg = $dame;
            $away->current_hp -= $dame;
        } else {
            //TODO: xử lý hiển thị né
            //$away->take_dmg = -1;
        }

        $this->turns[] = clone ($home);
        $this->turns[] = clone ($away);
    }
}
