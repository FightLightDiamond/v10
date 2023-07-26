<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_info',
        'turns',
        'start_time',
        'turn_number',
        'status',
        'winner',
        'loser',
        'type',
    ];
}
