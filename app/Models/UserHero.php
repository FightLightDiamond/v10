<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHero extends Model
{
    use HasFactory;
    protected $fillable = [
        'acc',
        'atk',
        'atk_healing',
        'cc',
        'crit_dmg',
        'crit_rate',
        'def',
        'dodge',
        'effect_resistance',
        'element',
        'hero_id',
        'hp',
        'intrinsic_status',
        'position',
        'skill',
        'spd',
        'status',
        'take_dmg_healing',
        'user_id',
    ];
}
