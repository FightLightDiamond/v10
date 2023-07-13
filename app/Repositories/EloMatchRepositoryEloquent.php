<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EloMatchRepository;
use App\Entities\EloMatch;
use App\Validators\EloMatchValidator;

/**
 * Class EloMatchRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EloMatchRepositoryEloquent extends BaseRepository implements EloMatchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EloMatch::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
