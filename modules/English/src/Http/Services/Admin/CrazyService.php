<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace English\Http\Services\Admin;

use English\Http\Repositories\CrazyRepository;

class CrazyService
{
    private $repository;

    public function __construct(CrazyRepository $repository)
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
        $crazy = $this->repository->store($params);

        $crazy->details()->createMany($params['details']);
        return $crazy;
    }

    public function show($id)
    {
        return $this->repository->with('details')->find($id);
    }

    public function edit($id)
    {
        return $this->repository->find($id);
    }

    public function update($params, $id)
    {
        $crazy = $this->repository->find($id);
        $details = $params['details'];
        $detailIds = $crazy->details()->pluck('id')->toArray();

        $ids = [];

        foreach ($details as $detail) {
            $id = $detail['id'] ?? null;
            $ids[] = $id;

            if(in_array($id, $detailIds)) {
                $crazy->details()->where('id', $id)->update($detail);
                continue;
            }

            $crazy->details()->create($detail);
        }

        $diffIds = array_diff($detailIds, $ids);
        $crazy->details()->whereIn('id', $diffIds)->delete();

        return $this->repository->change($params, $crazy);
    }

    public function destroy($id)
    {
        $crazy = $this->repository->find($id);

        if (! empty($crazy)) {
            $this->repository->delete($id);
        }

        return $crazy;
    }
}
