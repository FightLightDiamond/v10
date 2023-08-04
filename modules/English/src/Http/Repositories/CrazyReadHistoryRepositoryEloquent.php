<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazyReadHistory;

/**
 * ClassCrazyReadHistoryRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class CrazyReadHistoryRepositoryEloquent extends BaseRepository implements CrazyReadHistoryRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazyReadHistory::class;
    }

    public function myPaginate($params)
    {
        isset($params['per_page']) ?: $params['per_page'] = 10;

        return $this->makeModel()
            ->filter($params)
            ->paginate($params['per_page']);
    }

    public function store($params)
    {
        return $this->create($params);
    }

    public function edit($id)
    {
        $crazyReadHistory = $this->find($id);

        if (empty($crazyReadHistory)) {
            return $crazyReadHistory;
        }

        return compact('crazyReadHistory');
    }

    public function change($params, $data)
    {
        return $this->update($params, $data->id);
    }

    public function import($file)
    {
        set_time_limit(9999);
        $path = $this->makeModel()->uploadImport($file);

        return $this->importing($path);
    }

    private function standardized($params, $data)
    {
        return $data->uploads($params);
    }

    public function destroy($data)
    {
        return $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
