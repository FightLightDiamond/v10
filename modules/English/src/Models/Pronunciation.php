<?php

namespace English\Models;

use Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pronunciation extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'pronunciations';
    public $fillable = ['a', 'b', 'c', 'd',
        'pronunciation_a',  'pronunciation_b',  'pronunciation_c',  'pronunciation_d',
        'answer', 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input['question'])) {
            $query->where('a', $input['question'])
                ->orWhere('b', $input['question'])
                ->orWhere('c', $input['question'])
                ->orWhere('d', $input['question']);
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
        if (isset($input['is_active'])) {
            $query->where('is_active', $input['is_active']);
        }
        return $query;
    }
}

