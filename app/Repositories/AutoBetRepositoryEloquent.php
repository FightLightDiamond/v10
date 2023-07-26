<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AutoBetRepository;
use App\Models\AutoBet;
use App\Validators\AutoBetValidator;

/**
 * Class AutoBetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AutoBetRepositoryEloquent extends BaseRepository implements AutoBetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AutoBet::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
