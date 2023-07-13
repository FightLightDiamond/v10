<?php

namespace App\Http\Services;

class SkillService
{
    static function resetSkill($home, $away): array
    {
        $home->is_active_skill = false;
        $away->take_skill_dmg = 0;
        $home->take_dmg = 0;
        $away->effect_resistance = 0;
        return [$home, $away];
    }

    static function Hell($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        if ($home->current_hp / $home->hp <= 0.7 && $home->current_hp < $away->current_hp) {
            $home->is_active_skill = true;
            $home->current_atk += round(($away->current_hp - $home->current_hp) / 10);
        }

        $ratioAwayHp = $away->current_hp / $away->hp;

        if ($ratioAwayHp <= 0.3) {
            $home->is_active_skill = true;
            $away->current_hp = 0;
        }

        return [$home, $away];
    }

    static function Sphinx($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        $home->is_active_skill = true;

        $away->current_def -= round(
            30 + ($away->current_def > 0 ? $away->current_def * 0.1 : 0),
        );
        $away->def -= round(
            $home->current_atk * 0.03 + ($away->def > 0 ? $away->def * 0.2 : 0),
        );

        if ($home->turn_number % 2 === 0 && $home->current_hp < $away->current_hp) {
            $home->current_atk = round($home->current_atk * 1.2);
        }

        return [$home, $away];
    }

    static function Valkyrie($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        if ($home->intrinsic_status < 4) {
            $home->intrinsic_status += 1;
        }

        $home->is_active_skill = true;

        $dmg = round(0.02 * $home->intrinsic_status * $away->hp);
        $away->take_skill_dmg = $dmg;
        $away->current_hp -= $dmg;

        return [$home, $away];
    }

    static function Hera($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        if ($away->intrinsic_status !== 0 && $home->intrinsic_status == 0) {

            // Tang diem noi tai
            $home->intrinsic_status = 1;
            $away->current_atk = round($away->current_atk * 0.8);
            $away->atk = round($away->atk * 0.8);
        }

        if (rand(1, 100) > 30) {
            $home->current_crit_dmg = round($home->current_crit_dmg * 1.1);
        } else {
            // Cam skill
            $home->current_crit_rate += 5;
            $home->effect_resistance = 1;
        }

        //Kick hoat skill
        $home->is_active_skill = true;

        return [$home, $away];
    }

    static function Darklord($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        $ratioHp = $home->current_hp / $home->hp;

        if ($ratioHp <= 0.6) {
            $home->is_active_skill = true;
            $home->current_atk = round($home->current_atk * 1.6);
            $home->current_def = round($home->current_def * 1.5);
            $home->intrinsic_status = -1;
        }

        return [$home, $away];
    }

    static function Poseidon($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        if ($home->intrinsic_status < 10) {
            $home->is_active_skill = true;
            $home->intrinsic_status += 1;
            $home->current_atk = round($home->current_atk * 1.075);
            $home->current_def = round($home->current_def * 1.02);
        }

        return [$home, $away];
    }

    static function Fenrir($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        $home->is_active_skill = true;
        $home->current_crit_rate += 5;
        $home->current_crit_dmg += 20;
        $home->intrinsic_status += 1;

        return [$home, $away];
    }

    static function Chiron($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        $home->is_active_skill = true;
        $home->current_atk = round(
            $home->atk * (1 + (($home->hp - $home->current_hp) / $home->hp) * 0.85),
        );

        return [$home, $away];
    }

    static function Phoenix($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }
        $skillDame = round(($home->hp - $home->current_hp) * 0.09);
        $away->current_hp -= $skillDame;
        $away->take_skill_dmg = $skillDame;
        $home->is_active_skill = true;

        return [$home, $away];
    }

    static function Synthia($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        $home->intrinsic_status += 1;
        $away->take_skill_dmg = $home->intrinsic_status * $home->current_atk * 0.1;
        $away->current_hp -= $away->take_skill_dmg;

        return [$home, $away];
    }

    static function Amon($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }
        $home->is_active_skill = true;
        $home->intrinsic_status += 1;
        $home->current_hp += round($home->current_atk * 0.3);
        $away->current_def -= round(
            ($home->hp - $home->current_hp) * 0.006 + ($away->def > 0 ? $away->def * 0.2 : 0),
        );

        return [$home, $away];
    }

    static function Nezha($home, $away): array
    {
        if ($away->effect_resistance || $home->intrinsic_status === -1) {
            return SkillService::resetSkill($home, $away);
        }

        $ratioHp = $home->current_hp / $home->hp;
        if ($ratioHp <= 0.5 && rand(1, 100) <= 50) {
            $home->is_active_skill = true;
        }

        return [$home, $away];
    }
}
