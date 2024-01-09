<?php

namespace App\Models\English;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class CrazyCourse extends Model implements Transformable
{
    use TransformableTrait;


    public $table = 'crazy_courses';
    public $fillable = ['name', 'img', 'description', 'is_active', 'created_by', 'updated_by'];

    protected $appends = [
        'small_thumb',
        'medium_thumb',
        'large_thumb',
    ];

    public function crazies()
    {
        return $this->hasMany(Crazy::class, 'crazy_course_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
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
        return url("{$imgThumbs}");
    }


    public $fileUpload = ['img' => 1];
    protected $pathUpload = ['img' => '/images/crazy_courses'];
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

