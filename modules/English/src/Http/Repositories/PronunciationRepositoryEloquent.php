<?php

namespace English\Http\Repositories;


use Modularization\MultiInheritance\RepositoriesTrait;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use English\Models\Pronunciation;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PronunciationRepositoryEloquent extends BaseRepository implements PronunciationRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pronunciation::class;
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
        return $this->create($input);
    }

    public function edit($id)
    {
        $pronunciation = $this->find($id);
        if (empty($pronunciation)) {
            return $pronunciation;
        }
        return compact('pronunciation');
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
