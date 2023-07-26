<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TheMatchRepository;
use App\Models\TheMatch;
use App\Validators\TheMatchValidator;

/**
 * Class TheMatchRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TheMatchRepositoryEloquent extends BaseRepository implements TheMatchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TheMatch::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
