<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHeroItem extends Model
{
    use HasFactory;
    protected $fillable = [
    'hero_id',
    'item_id',
    'user_id',
    ];
}
