<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SectionTest extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'section_tests';
    public $fillable = ['section_id', 'questions', 'reply1', 'reply2', 'reply3', 'reply4', 'answer', 'is_active', 'created_by', 'updated_by'];

    public function scopeFilter($query, $params)
    {
        if(isset($params['section_id'])) {
                $query->where('section_id', $params['section_id']);
        }
        if(isset($params['questions'])) {
                $query->where('questions', $params['questions']);
        }
        if(isset($params['reply1'])) {
                $query->where('reply1', $params['reply1']);
        }
        if(isset($params['reply2'])) {
                $query->where('reply2', $params['reply2']);
        }
        if(isset($params['reply3'])) {
                $query->where('reply3', $params['reply3']);
        }
        if(isset($params['reply4'])) {
                $query->where('reply4', $params['reply4']);
        }
        if(isset($params['answer'])) {
                $query->where('answer', $params['answer']);
        }
        if(isset($params['is_active'])) {
                $query->where('is_active', $params['is_active']);
        }
        if(isset($params['created_by'])) {
                $query->where('created_by', $params['created_by']);
        }
        if(isset($params['updated_by'])) {
                $query->where('updated_by', $params['updated_by']);
        }

        return $query;
    }


    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/section_tests'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

