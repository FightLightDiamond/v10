<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace English\Http\Services\Admin;

use English\Http\Repositories\CrazyCourseRepository;

class CrazyCourseService
{
    private $repository;

    public function __construct(CrazyCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($params)
    {
        $params['{relationship}'] = null;
        $params['sort'] = 'id|desc';

        return $this->repository->filterGet($params);
    }

    public function store($params)
    {
        return $this->repository->store($params);
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function edit($id)
    {
        return $this->repository->find($id);
    }

    public function update($params, $id)
    {
        $crazyCourse = $this->repository->find($id);

        return $this->repository->change($params, $crazyCourse);
    }

    public function destroy($id)
    {
        $crazyCourse = $this->repository->find($id);

        if (! empty($crazyCourse)) {
            $this->repository->delete($id);
        }

        return $crazyCourse;
    }
}
