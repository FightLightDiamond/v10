<?php

namespace App\Models\English;


use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pronunciation extends Model implements Transformable
{
    use TransformableTrait;


    public $table = 'pronunciations';
    public $fillable = [A_COL, B_COL, C_COL, D_COL,
        PRONUNCIATION_A_COL,  PRONUNCIATION_B_COL,  PRONUNCIATION_C_COL,  PRONUNCIATION_D_COL,
        ANSWER_COL, 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input[QUESTION_COL])) {
            $query->where(A_COL, $input[QUESTION_COL])
                ->orWhere(B_COL, $input[QUESTION_COL])
                ->orWhere(C_COL, $input[QUESTION_COL])
                ->orWhere(D_COL, $input[QUESTION_COL]);
        }
        if (isset($input[A_COL])) {
            $query->where(A_COL, $input[A_COL]);
        }
        if (isset($input[B_COL])) {
            $query->where(B_COL, $input[B_COL]);
        }
        if (isset($input[C_COL])) {
            $query->where(C_COL, $input[C_COL]);
        }
        if (isset($input[D_COL])) {
            $query->where(D_COL, $input[D_COL]);
        }
        if (isset($input[ANSWER_COL])) {
            $query->where(ANSWER_COL, $input[ANSWER_COL]);
        }
        if (isset($input['is_active'])) {
            $query->where('is_active', $input['is_active']);
        }
        return $query;
    }

    public $fileUpload = [IMAGE_COL => 1];
    protected $pathUpload = [IMAGE_COL => '/images/pronunciations'];
    protected $thumbImage = [
        IMAGE_COL => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
}

