<?php


namespace English\Http\Services\API;


use English\Http\Repositories\CrazyCourseRepository;
use English\Models\CrazyHistory;
use English\Models\CrazyWriteHistory;

class CrazyCourseService
{
    protected CrazyCourseRepository $crazyCourseRepository;

    public function __construct(CrazyCourseRepository $crazyCourseRepository)
    {
        $this->crazyCourseRepository = $crazyCourseRepository;
    }

    public function index()
    {
        return $this->crazyCourseRepository->withCount('crazies')->all(['id', 'name', 'img', 'description']);
    }

    public function show($id, $user_id)
    {
        $relationship = ['crazies:id,name,crazy_course_id'];
        $select = ['id', 'name', 'img', 'description'];
        $course = $this->crazyCourseRepository->with($relationship)->find($id, $select);

        if ($user_id) {
            $this->auth($user_id, $course->crazies);
        }

        return $course;
    }

    private function auth($user_id, $crazies)
    {
        $filter = [
            'user_id' => $user_id,
            'type' => 0
        ];

        foreach ($crazies as $item) {
            $filter['crazy_id'] = $item->id;
            $item->no_read = CrazyHistory::filter($filter)->count();
            $item->avg_score_read = round(CrazyHistory::filter($filter)->avg('score') / 100, 2);
            $item->no_write = CrazyWriteHistory::filter($filter)->count();
            $item->avg_score_write = round(CrazyWriteHistory::filter($filter)->avg('score') / 100, 2);
        }

        return $crazies;
    }
}
