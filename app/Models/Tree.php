<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;
    protected $fillable = [
    'end_time',
    'starting_value',
    'start_time',
    'status',
    'user_id',

    ];
}
