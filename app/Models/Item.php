<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'image',
        'level',
        'value',
        'hero_id',
        'user_id',
    ];
}
