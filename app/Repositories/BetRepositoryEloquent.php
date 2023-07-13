<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BetRepository;
use App\Entities\Bet;
use App\Validators\BetValidator;

/**
 * Class BetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BetRepositoryEloquent extends BaseRepository implements BetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bet::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
