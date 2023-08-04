<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\LessonTest;

/**
 * Class NewsRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class LessonTestRepositoryEloquent extends BaseRepository implements LessonTestRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name'subject_id'
     *
     * @return string
     */
    public function model()
    {
        return LessonTest::class;
    }

    public function myPaginate($params)
    {
        isset($params['per_page']) ?: $params['per_page'] = 10;
        return $this->makeModel()
            ->filter($params)
            ->with(['lesson:id,title', 'creator:id,email', 'updater:id,email'])
            ->paginate($params['per_page']);
    }

    public function store($params)
    {
        $params['created_by'] = auth()->id();
        $params['updated_by'] = auth()->id();
        $params = $this->standardized($params, $this->makeModel());
        $this->create($params);
    }

    public function edit($id)
    {
        $lessonTest = $this
            ->with(['lesson:id,section_id', 'lesson.section:id,tutorial_id', 'lesson.section.tutorial:id'])
            ->find($id);
        if(empty($lessonTest)) {
            return $lessonTest;
        }
        $section_id = 0;
        $tutorial_id = 0;
        $sectionList = [];
        $lessonList = [];
        if(isset($lessonTest->lesson->section)) {
            $section = $lessonTest->lesson->section;
            $section_id = $section->id;
            $lessonList = $section->lessons()->pluck('title', 'id')->toArray();
            if($section->tutorial) {
                $tutorial_id = $section->tutorial->id;
                $sectionList = $section->tutorial->sections()->pluck('name', 'id')->toArray();
            }
        }
        $replies = [1 => 'A', 2 => 'B', 3=> 'C', 4=> 'D'];
        return compact('lessonTest', 'lessonList', 'sectionList', 'tutorial_id', 'section_id', 'replies');
    }

    public function change($params, $data)
    {
        $params['updated_by'] = auth()->id();
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
        $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
