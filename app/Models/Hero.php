<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;
    protected $fillable = [
    'acc',
    'atk',
    'atk_healing',
    'cc',
    'code',
    'crit_dmg',
    'crit_rate',
    'def',
    'dodge',
    'effect_resistance',
    'element',
    'guide',
    'hp',
    'intrinsic_status',
    'name',
    'position',
    'skill',
    'spd',
    'status',
    'story',
    'take_dmg_healing',
    ];
}
