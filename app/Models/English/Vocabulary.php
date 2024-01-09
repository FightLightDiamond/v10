<?php

namespace App\Models\English;


use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{

    public $table = VOCABULARIES_TB;
    public $fillable = [WORD_COL, 'type', PRONOUNCE_COL, 'meaning', IMAGE_COL, DESCRIPTION_COL, 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input['is_active'])) {
            $query->where('is_active', $input['is_active']);
        }
        if (isset($input['type'])) {
            $query->where('type', 'LIKE', '%' . $input['type'] . '%');
        }
        if (isset($input[PRONOUNCE_COL])) {
            $query->where(PRONOUNCE_COL, 'LIKE', '%' . $input[PRONOUNCE_COL] . '%');
        }
        if (isset($input['meaning'])) {
            $query->where('meaning', 'LIKE', '%' . $input['meaning'] . '%');
        }
        if (isset($input[WORD_COL])) {
            $query->where(WORD_COL, 'LIKE', '%' . $input[WORD_COL] . '%');
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

