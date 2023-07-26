<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGem extends Model
{
    use HasFactory;
    protected $fillable = [
    'attached_num',
    'available_num',
    'level',
    'type',
    'user_id',
    ];
}
