<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function firstLock(int $id)
    {
        return $this->model
            ->newQuery()
            ->lockForUpdate()
            ->find($id);
    }

    public function getOrderLimit(array $order, int $limit): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->model
            ->newQuery()
            ->orderBy($order[0], $order[1])
            ->limit($limit)
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
