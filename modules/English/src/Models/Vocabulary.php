<?php

namespace English\Models;

use Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use ModelsTrait;
    public $fillable = ['word', 'type', 'pronounce', 'meaning', 'image', 'description', 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input['is_active'])) {
            $query->where('is_active', $input['is_active']);
        }
        if (isset($input['type'])) {
            $query->where('type', 'LIKE', '%' . $input['type'] . '%');
        }
        if (isset($input['pronounce'])) {
            $query->where('pronounce', 'LIKE', '%' . $input['pronounce'] . '%');
        }
        if (isset($input['meaning'])) {
            $query->where('meaning', 'LIKE', '%' . $input['meaning'] . '%');
        }
        if (isset($input['word'])) {
            $query->where('word', 'LIKE', '%' . $input['word'] . '%');
        }
        return $query;
    }

    public function getImageAttribute($value)
    {
        return url('storage' . $value);
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/vocabulary'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [50, 50], [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

