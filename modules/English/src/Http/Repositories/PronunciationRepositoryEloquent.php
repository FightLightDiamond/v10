<?php

namespace English\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\Pronunciation;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class PronunciationRepositoryEloquent extends BaseRepository implements PronunciationRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pronunciation::class;
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
        return $this->create($params);
    }

    public function edit($id)
    {
        $pronunciation = $this->find($id);
        if (empty($pronunciation)) {
            return $pronunciation;
        }
        return compact('pronunciation');
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
