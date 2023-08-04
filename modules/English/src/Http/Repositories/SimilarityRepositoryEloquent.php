<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\Similarity;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class SimilarityRepositoryEloquent extends BaseRepository implements SimilarityRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Similarity::class;
    }

    public function myPaginate($params)
    {

        return $this->makeModel()
            ->filter($params)
            ->orders(isset($params['orderBy']) ? $params['orderBy'] : [ 'id' => 'DESC' ])
            ->paginate(10);

    }

    public function store($params)
    {
        $params['created_by'] = auth()->id();
        $params = $this->standardized($params, $this->makeModel());
        return $this->create($params);
    }

    public function edit($id)
    {
        $Similarity = $this->find($id);
        if (empty($Similarity)) {
            return $Similarity;
        }
        return compact('Similarity');
    }

    public function change($params, $data)
    {
        $params['updated_by'] = auth()->id();
        $params = $this->standardized($params, $data);
        return $this->update($params, $data->id);
    }

    private function standardized($params, $data)
    {
        $params = $data->uploads($params);
        return $data->checkbox($params);
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
