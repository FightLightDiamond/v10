<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace English\Http\Services\API;

use English\Http\Repositories\CrazyReadHistoryRepository;

class CrazyReadHistoryService
{
    private $repository;

    public function __construct(CrazyReadHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($params)
    {
        $params['{relationship}'] = ['crazy:id,name,crazy_course_id', 'crazy.crazyCourse:id,name'];
        $params['sort'] = 'id|desc';

        return $this->repository->myPaginate($params);
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
        $crazyReadHistory = $this->repository->find($id);

        return $this->repository->change($params, $crazyReadHistory);
    }

    public function destroy($id)
    {
        $crazyReadHistory = $this->repository->find($id);

        if (! empty($crazyReadHistory)) {
            $this->repository->delete($id);
        }

        return $crazyReadHistory;
    }
}
