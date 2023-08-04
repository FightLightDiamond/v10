<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class SectionResult extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'section_results';
    public $fillable = ['created_by', 'section_id', 'score'];

    public function scopeFilter($query, $params)
    {
        if(isset($params['created_by'])) {
                $query->where('created_by', $params['created_by']);
        }
        if(isset($params['section_id'])) {
                $query->where('section_id', $params['section_id']);
        }
        if(isset($params['score'])) {
                $query->where('score', $params['score']);
        }

        return $query;
    }


    public array $fileUpload = ['image' => 1];
    protected array $pathUpload = ['image' => '/images/section_results'];
    protected array $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected array $checkbox = ['is_active'];
}

