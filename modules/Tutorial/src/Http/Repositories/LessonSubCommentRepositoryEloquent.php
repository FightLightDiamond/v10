<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\LessonSubComment;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class LessonSubCommentRepositoryEloquent extends BaseRepository implements LessonSubCommentRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LessonSubComment::class;
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
        $this->create($params);
    }

    public function change($params, $data)
    {
        $params = $this->standardized($params, $data);
        $this->update($params, $data->id);
    }


    private function standardized($params, $data)
    {
        $params = $data->uploads($params);
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
