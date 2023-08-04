<?php

namespace Tutorial\Http\Repositories;


use Illuminate\Support\Facades\DB;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\Section;
use Tutorial\Models\Tutorial;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class TutorialRepositoryEloquent extends BaseRepository implements TutorialRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tutorial::class;
    }

    public function myPaginate($params)
    {
        isset($params['per_page']) ?: $params['per_page'] = 10;
        return $this->makeModel()
            ->with(['sections:id,name', 'creator:id,email', 'updater:id,email'])
            ->filter($params)
            ->paginate($params['per_page']);

    }

    public function store($params)
    {
        $params = $this->standardized($params, $this->makeModel());
        $model = $this->create($params);
        if (isset($params['section_names'])) {
            $data = [];
            $now = now();
            foreach ($params['section_names'] as $value) {
                array_push($data, ['name' => $value, 'tutorial_id' => $model->id, ]);
            }
            DB::table('sections')->insert($data);
        }
        return $model;
    }

    public function change($params, $data)
    {
        $params = $this->standardized($params, $data);
        if(isset($params['section_ids'])) {
            foreach ($params['section_ids'] as $k => $section_id)
            {
                if($section_id == 0) {
                    $lesson = [
                        'tutorial_id' => $data->id,
                        'no' => $k,
                        'name' => $params['section_names'][$k],
                        'create_by' => auth()->id()
                    ];
                    app(Section::class)->create($lesson);
                } else {
                    DB::table('sections')->where('id', $section_id)->update(['no' => $k, 'name' => $params['section_names'][$k]]);
                }
            }
        }

        return $this->update($params, $data->id);
    }

    private function standardized($params, $data)
    {
        $params = $data->uploads($params);
        return $data->checkbox($params);
    }

    public function destroy($id)
    {
        $tutorial = $this->withCount('sections')->find($id);
        if (empty($tutorial)) {
            session()->flash('error', 'Tutorial not found ');
        } elseif ($tutorial->sections_count !== 0) {
            session()->flash('error', 'Can\'t destroy, please delete all it\'section');
        } else {
            session()->flash('success', 'delete success');
            $this->delete($id);
        }
        return $tutorial;
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
