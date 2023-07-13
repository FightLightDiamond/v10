<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserGemRepository;
use App\Entities\UserGem;
use App\Validators\UserGemValidator;

/**
 * Class UserGemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserGemRepositoryEloquent extends BaseRepository implements UserGemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserGem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
