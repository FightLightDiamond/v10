<?php

namespace English\Http\Repositories;


use Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazyHistory;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CrazyHistoryRepositoryEloquent extends BaseRepository implements CrazyHistoryRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazyHistory::class;
    }

    public function myPaginate($input)
    {

        return $this->makeModel()
            ->filter($input)
            ->orderBy('id', 'DESC')
            ->paginate($input['per_page'] ?? 10);
    }

    public function store($input)
    {
        $input['created_by'] = auth()->id();
        return $this->create($input);
    }

    public function edit($id)
    {
        $_var_ = $this->find($id);
        if (empty($_var_)) {
            return $_var_;
        }
        return compact('_var_');
    }

    public function change($input, $data)
    {
        $input['updated_by'] = auth()->id();
        return $this->update($input, $data->id);
 }

    private function standardized($input, $data)
    {
        return $data->uploads($input);
    }

    public function destroy($data)
    {
        return $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
