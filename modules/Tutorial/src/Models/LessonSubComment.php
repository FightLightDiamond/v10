<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LessonSubComment extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lesson_sub_comments';
    public $fillable = ['lesson_comment', 'content', 'create_by', 'is_active'];

    public function scopeFilter($query, $params)
    {
        if(isset($params['lesson_comment'])) {
                $query->where('lesson_comment', $params['lesson_comment']);
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
    protected $pathUpload = ['image' => '/images/lesson_sub_comments'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

