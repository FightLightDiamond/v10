<?php

namespace App\Models\English;


use App\Models\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Similarity extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'similarities';
    public $fillable = ['question', 'replacement', 'a', 'b', 'c', 'd', 'answer', 'reason', 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input['question'])) {
            $query->where('question', 'LIKE', '%' . $input['question'] . '%');
        }
        if (isset($input['replacement'])) {
            $query->where('replacement', $input['replacement']);
        }
        if (isset($input['a'])) {
            $query->where('a', $input['a']);
        }
        if (isset($input['b'])) {
            $query->where('b', $input['b']);
        }
        if (isset($input['c'])) {
            $query->where('c', $input['c']);
        }
        if (isset($input['d'])) {
            $query->where('d', $input['d']);
        }
        if (isset($input['answer'])) {
            $query->where('answer', $input['answer']);
        }
        if (isset($input['reason'])) {
            $query->where('reason', $input['reason']);
        }
        if (isset($input['is_active'])) {
            $query->where('is_active', $input['is_active']);
        }
        return $query;
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/similarities'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

