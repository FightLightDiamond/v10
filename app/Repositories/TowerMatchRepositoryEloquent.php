<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TowerMatchRepository;
use App\Models\TowerMatch;
use App\Validators\TowerMatchValidator;

/**
 * Class TowerMatchRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TowerMatchRepositoryEloquent extends BaseRepository implements TowerMatchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TowerMatch::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
