<?php

namespace English\Http\Repositories;


use Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\CrazyWriteHistory;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CrazyWriteHistoryRepositoryEloquent extends BaseRepository implements CrazyWriteHistoryRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrazyWriteHistory::class;
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
        $crazyWriteHistory = $this->find($id);
        if (empty($crazyWriteHistory)) {
            return $crazyWriteHistory;
        }
        return compact('crazyWriteHistory');
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
