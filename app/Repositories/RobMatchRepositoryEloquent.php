<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RobMatchRepository;
use App\Entities\RobMatch;
use App\Validators\RobMatchValidator;

/**
 * Class RobMatchRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RobMatchRepositoryEloquent extends BaseRepository implements RobMatchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RobMatch::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
