<?php

namespace English\Http\Repositories;


use Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\Mistake;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class MistakeRepositoryEloquent extends BaseRepository implements MistakeRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Mistake::class;
    }

    public function myPaginate($input)
    {
        return $this->makeModel()
            ->filter($input)
            ->orders( $input['orderBy'] ?? [ 'id' => 'DESC' ])
            ->paginate($input['per_page'] ?? 10);

    }

    public function store($input)
    {
        $input['created_by'] = auth()->id();
        $input = $this->standardized($input, $this->makeModel());
        return $this->create($input);
    }

    public function edit($id)
    {
        $Mistake = $this->find($id);
        if(empty($Mistake))
        {
            return $Mistake;
        }
        return compact('Mistake');
    }

    public function change($input, $data)
    {
        $input['updated_by'] = auth()->id();
        $input = $this->standardized($input, $data);
        return $this->update($input, $data->id);
 }

    private function standardized($input, $data)
    {
        $input = $data->uploads($input);
        return $data->checkbox($input);
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
