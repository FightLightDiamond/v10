<?php

namespace App\Models\English;


use App\Models\CrazyStory;
use App\Models\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyDetail extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_details';
    public $fillable = [
        'crazy_id',
        'no',
        'time',
        'sentence',
        'meaning',
        'ipa',
        'created_by',
        'updated_by',
        'is_active'
    ];

    #-------------------Relation ship----------------------

    public function crazyStories()
    {
        return $this->hasMany(CrazyStory::class);
    }

    public function crazy()
    {
        return $this->belongsTo(Crazy::class);
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/crazy_details'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

