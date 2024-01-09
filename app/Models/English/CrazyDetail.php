<?php

namespace App\Models\English;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyDetail extends Model implements Transformable
{
    use TransformableTrait;


    public $table = 'crazy_details';
    public $fillable = ['crazy_id', 'no', 'time', 'sentence', 'meaning', 'created_by', 'updated_by', 'is_active'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/crazy_details'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

