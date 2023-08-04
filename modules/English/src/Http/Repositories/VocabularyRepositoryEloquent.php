<?php

namespace English\Http\Repositories;

use English\Models\Vocabulary;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class VocabularyRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class VocabularyRepositoryEloquent extends BaseRepository implements VocabularyRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vocabulary::class;
    }

    public function myPaginate($params)
    {

        return $this->makeModel()
            ->filter($params)
            ->orders(isset($params['orderBy']) ? $params['orderBy'] : [ 'id' => 'DESC' ])
            ->paginate(10);
    }

    public function store($params)
    {
        $params = $this->standardized($params, $this->makeModel());
        $this->create($params);
    }

    public function change($params, $vocabulary)
    {
        $params = $this->standardized($params, $vocabulary);
        return $this->update($params, $vocabulary->id);
    }

    public function destroy($data)
    {
        // TODO: Implement destroy() method.
    }

    private function standardized($params, $vocabulary)
    {
        $params = $vocabulary->uploads($params);
        return $vocabulary->checkbox($params);
    }


    public function export($params)
    {
        $data = $this->makeModel()
            ->filter($params)
            ->limit(9999)
            ->get();

        Excel::create(
            'file', function ($excel) use ($data) {
                $excel->setTitle('Vocabulary');
                $excel->setCreator('Fight Light Diamond')->setCompany('Conquer');
                // $excel->setDescr
            }
        );
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
