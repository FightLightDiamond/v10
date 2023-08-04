<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\LessonResult;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class LessonResultRepositoryEloquent extends BaseRepository implements LessonResultRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LessonResult::class;
    }

    public function myPaginate($params)
    {
        isset($params['per_page']) ?: $params['per_page'] = 10;
        return $this->makeModel()
            ->with(['creator:id,email', 'lesson:id,title'])
            ->filter($params)
            ->paginate($params['per_page']);

    }

    public function store($params)
    {
        $params['create_by'] = auth()->check() ? auth()->id() : null;
        $this->create($params);
    }

    public function change($params, $data)
    {
        $this->update($params, $data->id);
    }

    private function standardized($params, $data)
    {
        return $data->checkbox($params);
    }

    public function destroy($data)
    {
        // TODO: Implement remove() method.
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
