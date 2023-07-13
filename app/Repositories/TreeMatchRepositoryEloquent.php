<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TreeMatchRepository;
use App\Entities\TreeMatch;
use App\Validators\TreeMatchValidator;

/**
 * Class TreeMatchRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TreeMatchRepositoryEloquent extends BaseRepository implements TreeMatchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TreeMatch::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
