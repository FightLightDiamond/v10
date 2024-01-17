<?php

namespace App\Models\English;


use App\Models\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyHistory extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_histories';
    public $fillable = ['user_id', 'crazy_id', 'score', 'type'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/crazy_histories'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

