<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserHeroItemRepository;
use App\Models\UserHeroItem;
use App\Validators\UserHeroItemValidator;

/**
 * Class UserHeroItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserHeroItemRepositoryEloquent extends BaseRepository implements UserHeroItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserHeroItem::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
