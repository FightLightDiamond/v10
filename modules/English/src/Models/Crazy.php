<?php

namespace English\Models;

use App\Models\ModelsTrait;
use Illuminate\Database\Eloquent\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Crazy extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazies';
    public $fillable = [
        'name',
        'img',
        'audio',
        'description',
        'created_by',
        'updated_by',
        'is_active',
        'crazy_course_id'
    ];

    protected $appends = [
        'small_thumb',
        'medium_thumb',
        'large_thumb',
    ];

    public function details()
    {
        return $this->hasMany(CrazyDetail::class, 'crazy_id');
    }

    public function crazyCourse()
    {
        return $this->belongsTo(CrazyCourse::class, 'crazy_course_id');
    }


    public function getImgAttribute($value)
    {
        return url('storage' . $value);
    }

    public function getSmallThumbAttribute($value)
    {
        return $this->getThumbPath('img', [200, 200]);
    }

    public function getMediumThumbAttribute($value)
    {
        return $this->getThumbPath('img', [300, 300]);
    }

    public function getLargeThumbAttribute($value)
    {
        return $this->getThumbPath('img', [400, 400]);
    }

    public function getThumbPath($field, $sizes)
    {
        $img = $this->$field;
        $sizeImage = '_' . implode('_', $sizes) . '.';
        $imgThumbs = str_replace('.', $sizeImage, $img);
        return assert("{$imgThumbs}");
    }


    public function getAudioPath()
    {
        return asset('storage' . $this['audio']);
    }

    public function getAudioAttribute($value)
    {
        return url('storage' . $value);
    }

    public $fileUpload = [
        'audio' => 0,
        'img' => 1
    ];
    protected $pathUpload = [
        'audio' => '/audio/crazies',
        'img' => '/images/crazy_courses'
    ];
    protected $thumbImage = [
        'img' => [
            '/thumbs/' => [
                [200, 200],
                [300, 300],
                [400, 400],
            ]
        ]
    ];
}

