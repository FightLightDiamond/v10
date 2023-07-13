<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::query()->truncate();

        $heroesName = [
            'Fenrir',
            'Phoenix',
            'Hell',
            'Darklord',
            'Valkyrie',
            'Poseidon',
            'Hera',
            'Chiron',
        ];

        $data = [];

        foreach ($heroesName as $heroName) {
            $data[] = [
                'hp' => 10000,
                'atk' => 1000,
                'def' => 200,
                'spd' => 100,
                'crit_rate' => 20,
                'crit_dmg' => 200,
                // L1
                'atk_healing' => 15,
                'take_dmg_healing' => 10,
                'dodge' => 10,
                'acc' => 100,
                'name' => $heroName,
                'code' => $heroName
            ];
        }

        Hero::query()->insert($data);
    }
}
