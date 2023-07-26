<?php

namespace App\Http\Services;

use Exception;

class SkillFactory
{
    /**
     * @throws Exception
     */
    static function create($home, $away): array
    {
        dd($home->name);
        return match ($home->name) {
            'Hell' => SkillService::Hell($home, $away),
            'Sphinx' => SkillService::Sphinx($home, $away),
            'Darklord' => SkillService::Darklord($home, $away),
            'Valkyrie' => SkillService::Valkyrie($home, $away),
            'Poseidon' => SkillService::Poseidon($home, $away),
            'Phoenix' => SkillService::Phoenix($home, $away),
            'Chiron' => SkillService::Chiron($home, $away),
            'Hera' => SkillService::Hera($home, $away),
            'Fenrir' => SkillService::Fenrir($home, $away),
            'Amon' => SkillService::Amon($home, $away),
            'Nezha' => SkillService::Nezha($home, $away),
            default => throw new Exception('Not found skill for Hero'),
        };
    }
}
