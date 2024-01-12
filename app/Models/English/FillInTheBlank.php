<?php

namespace App\Models\English;

use Illuminate\Database\Eloquent\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class FillInTheBlank extends Model implements Transformable
{
    use TransformableTrait;


    public $table = 'fill_in_the_blanks';
    public $fillable = [QUESTION_COL, A_COL, B_COL, C_COL, D_COL, ANSWER_COL, 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input[QUESTION_COL])) {
            $query->where(QUESTION_COL, 'LIKE', '%' . $input[QUESTION_COL] . '%');
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

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/fill_in_the_blanks'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}
