<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TutorialResult extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'tutorial_results';
    public $fillable = ['created_by', 'tutorial_id', 'score'];

    public function scopeFilter($query, $params)
    {
        if (isset($params['created_by'])) {
            $query->where('created_by', $params['created_by']);
        }
        if (isset($params['tutorial_id'])) {
            $query->where('tutorial_id', $params['tutorial_id']);
        }
        if (isset($params['score'])) {
            $query->where('score', $params['score']);
        }

        return $query;
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/tutorial_results'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

