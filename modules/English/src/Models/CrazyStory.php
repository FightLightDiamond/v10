<?php
namespace English\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrazyStory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      'crazy_detail_id',
      'story',
    ];

    public function crazyDetail()
    {
        return $this->belongsTo(CrazyDetail::class, 'crazy_detail_id');
    }
}
