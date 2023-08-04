<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Section extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'sections';
    public $fillable = ['name', 'img', 'tutorial_id', 'description', 'is_active'];

    public function scopeFilter($query, $params)
    {
        if (isset($params['name'])) {
            $query->where('name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['img'])) {
            $query->where('img', $params['img']);
        }
        if (isset($params['is_active'])) {
            $query->where('is_active', $params['is_active']);
        }
        if (isset($params['tutorial_id'])) {
            $query->where('tutorial_id', $params['tutorial_id']);
        }
        return $query;
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'section_id');
    }

    public $fileUpload = ['img' => 1];
    protected $pathUpload = ['img' => '/images/sections'];
    protected $thumbImage = [
        'img' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

