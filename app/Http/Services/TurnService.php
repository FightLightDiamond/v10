<?php

namespace App\Http\Services;

class TurnService
{
    /**
     * Turn
     *
     * @param  $home
     * @param  $away
     * @return array
     * @throws \Exception
     */
    static function turn($home, $away): array
    {
        //Reset
        $home->is_active_skill = false;
        $home->take_skill_dmg = 0;
        $home->take_dmg = 0;

        $away->is_active_skill = false;
        $away->take_dmg = 0;
        $away->take_skill_dmg = 0;
        // Skill
        [$i, $y] = SkillFactory::create($home, $away);
        $home = $i;
        $away = $y;

        // $Dame
        $dame = $home->current_atk;

        // Random xac suat crit
        $bProbability = rand(1, 100);

        if ($bProbability <= $home->current_crit_rate) {
            $dame = round(($dame * $home->current_crit_dmg) / 100);
            $home->is_crit = true;
        }

        $dame -= $away->current_def;
        if ($dame < 0) {
            $dame = 1;
        }
        $away->take_dmg = $dame;
        $away->current_hp -= $dame;

        return [$home, $away];
    }
}
