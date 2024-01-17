<?php

namespace English\Models;

use Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyWriteHistory extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_write_histories';
    public $fillable = ['user_id', 'crazy_id', 'score', 'type'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/crazy_write_histories'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

