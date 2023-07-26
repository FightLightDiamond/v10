<?php

namespace App\Http\Services;

class HeroLogService
{
    public $id;
    public $atk;
    public $def;
    public $crit_rate;
    public $crit_dmg;
    public $effect_resistance;
    public $hp;
    public $intrinsic_status;
    public $name ;
    public $spd;
    public $atk_healing;
    public $is_active_skill;
    public $is_crit;
    public $take_dmg;
    public $take_dmg_healing;
    public $take_skill_dmg;
    public $status;

    //Base stats
    public $current_hp;
    public $current_atk;
    public $current_def;
    public $current_spd;
    // Special stats
    public $current_crit_rate;
    public $current_crit_dmg;
    // L1
    public $current_atk_healing;
    public $current_take_dmg_healing;
    // L2
    public $current_dodge;
    public $current_acc;
    // L3
    public $current_cc;
    public $logs = [];
    public $turn_number;
    public $is_atk;
    public $dodge;
    public $acc;
    public $cc;

    /**
     * Set Attribute
     */
    function setCurrent($home)
    {
        foreach ($home->toArray() as $key => $value)
        {
            $this->$key = $value;
            $this->{"current_$key"} = $value;
        }

        return $this;
    }

    /**
     * Hero atk
     *
     * @param $away
     */
    function attack($away)
    {
        // Turn 1
        [$home2, $away2] = TurnService::turn($this, $away);

        if ($away2->current_hp <= 0) {
            return [$home2, $away2];
        }

        // Turn 2
        [$away3, $home3] = TurnService::turn($away2, $home2);

        if ($home3->current_hp <= 0) {
            return [$home3, $away3];
        }

        return [$home2, $away2, $home3, $away3];
    }
}
