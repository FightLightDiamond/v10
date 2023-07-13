<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserHeroRepository;
use App\Entities\UserHero;
use App\Validators\UserHeroValidator;

/**
 * Class UserHeroRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserHeroRepositoryEloquent extends BaseRepository implements UserHeroRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserHero::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
