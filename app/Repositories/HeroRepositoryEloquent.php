<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HeroRepository;
use App\Entities\Hero;
use App\Validators\HeroValidator;

/**
 * Class HeroRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HeroRepositoryEloquent extends BaseRepository implements HeroRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Hero::class;
    }

    public function getPairHeroes()
    {
        $select = [
            'id',
            'name',
            'atk',
            'hp',
            'def',
            'dodge',
            'crit_rate',
            'crit_dmg',
            'spd',
        ];

        return $this->makeModel()->newQuery()
            ->select($select)
            ->inRandomOrder()
            ->limit(2)
            ->get();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
