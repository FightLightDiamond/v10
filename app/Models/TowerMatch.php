<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TowerMatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'bet_percentage',
        'hero_id',
        'is_enable',
        'rival_pair',
        'user_id',
    ];
}
