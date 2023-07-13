<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TreeRepository;
use App\Entities\Tree;
use App\Validators\TreeValidator;

/**
 * Class TreeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TreeRepositoryEloquent extends BaseRepository implements TreeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tree::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
