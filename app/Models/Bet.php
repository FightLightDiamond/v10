<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;
    protected $fillable = [
    'balance',
    'hero_id',
    'match_id',
    'result',
    'user_id',
    ];
}
