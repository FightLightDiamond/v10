<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace English\Http\Services\API;

use English\Http\Repositories\RemindRepository;

class RemindService
{
    private $repository;

    public function __construct(RemindRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($params)
    {
        $params['{relationship}'] = null;
        $params['sort'] = 'id|desc';

        return $this->repository->myPaginate($params);
    }

    public function store($params)
    {
        $params['job'] = "{$params['minute']} {$params['hour']} * * * ";

        $remind = $this->repository->filterFirst(['user_id' => $params['user_id']]);

        if ($remind) {
            $remind->update($params);
            return $remind->refresh();
        }

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
        $remind = $this->repository->find($id);

        return $this->repository->change($params, $remind);
    }

    public function destroy($id)
    {
        $remind = $this->repository->find($id);

        if (!empty($remind)) {
            $this->repository->delete($id);
        }

        return $remind;
    }
}
