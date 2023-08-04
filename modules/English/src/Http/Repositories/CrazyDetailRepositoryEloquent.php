<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazyDetail;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class CrazyDetailRepositoryEloquent extends BaseRepository implements CrazyDetailRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazyDetail::class;
    }

    public function myPaginate($params)
    {

        return $this->makeModel()
            ->filter($params)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function store($params)
    {
        $params['created_by'] = auth()->id();
        return $this->create($params);
    }

    public function edit($id)
    {
        return $this->find($id);
    }

    public function change($params, $data)
    {
        $params['updated_by'] = auth()->id();
        return $this->update($params, $data->id);
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
