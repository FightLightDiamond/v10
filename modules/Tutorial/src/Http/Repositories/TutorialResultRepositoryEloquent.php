<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\Section;
use Tutorial\Models\TutorialResult;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class TutorialResultRepositoryEloquent extends BaseRepository implements TutorialResultRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TutorialResult::class;
    }

    public function myPaginate($params)
    {
        isset($params['per_page']) ?: $params['per_page'] = 10;
        return $this->makeModel()
            ->with(['creator:id,email', 'tutorial:id,name'])
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
        if(isset($params['section_names'])) {
            $sectionIds= [];
            foreach ($params['section_names'] as $name)
            {
                $section = $this->app(Section::class)->firstOrCreate(compact('name'));
                $sectionIds[] = $section->id;
            }
            $data->sections()->sync($sectionIds);
        }
        $params = $data->uploads($params);
        return $data->checkbox($params);
    }

    public function destroy($id)
    {
        $tutorial = $this->withCount('sections')->find($id);

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
