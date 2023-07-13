<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\BankBranch;
use App\Models\User;
use App\Models\UserHero;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::query()->truncate();
        UserHero::query()->truncate();
        for ($i = 1; $i < 100; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('12345Aa@')
            ]);

            UserHero::query()->create([
                'user_id' => $i,
                'hero_id' => rand(1, 8),
            ]);
        }
    }
}
