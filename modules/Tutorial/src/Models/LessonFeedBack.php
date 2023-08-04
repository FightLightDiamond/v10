<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonFeedBack extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lesson_feed_backs';
    public $fillable = ['lesson_id', 'title', 'content', 'create_by', 'is_active'];

    public function scopeFilter($query, $params)
    {
        if(isset($params['lesson_id'])) {
                $query->where('lesson_id', $params['lesson_id']);
        }
        if(isset($params['title'])) {
                $query->where('title', $params['title']);
        }
        if(isset($params['content'])) {
                $query->where('content', $params['content']);
        }
        if(isset($params['create_by'])) {
                $query->where('create_by', $params['create_by']);
        }
        if(isset($params['is_active'])) {
                $query->where('is_active', $params['is_active']);
        }

        return $query;
    }


    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/lesson_feed_backs'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

