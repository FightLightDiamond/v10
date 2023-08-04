<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazySpeakHistory;

/**
 * ClassCrazySpeakHistoryRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class CrazySpeakHistoryRepositoryEloquent extends BaseRepository implements CrazySpeakHistoryRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazySpeakHistory::class;
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
        $params = $this->standardized($params, $this->makeModel());
        return $this->create($params);
    }

    public function edit($id)
    {
        $crazySpeakHistory = $this->find($id);

        if (empty($crazySpeakHistory)) {
            return $crazySpeakHistory;
        }

        return compact('crazySpeakHistory');
    }

    public function change($params, $data)
    {
        $params = $this->standardized($params, $this->makeModel());
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
