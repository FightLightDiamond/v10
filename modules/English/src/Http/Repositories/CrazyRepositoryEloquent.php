<?php

namespace English\Http\Repositories;


use English\Models\Crazy;
use Modularization\MultiInheritance\RepositoriesTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CrazyRepositoryEloquent extends BaseRepository implements CrazyRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Crazy::class;
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
        $input = $this->standardized($input, $this->makeModel());
        $crazy = $this->create($input);
        if (isset($input['sentences'])) {
            $this->detailCreates($input, $crazy);
        }
    }

    public function detailCreates($input, $crazy)
    {
        $data = [];
        foreach ($input['sentences'] as $no => $sentence) {
            $data[] = [
                'sentence' => $sentence,
                'meaning' => $input['meanings'][$no],
                'time' => $input['times'][$no],
                'no' => $no + 1,
                'is_active' => 1,
                'created_by' => auth()->id(),
            ];
        }
        $crazy->details()->createMany($data);
    }

    public function edit($id)
    {
        $crazy = $this->find($id);
        if (empty($crazy)) {
            return $crazy;
        }
        $details = $crazy->details()->orderBy('no')->get();
        return compact('crazy', 'details');
    }

    public function change($input, $crazy)
    {
        $input['updated_by'] = auth()->id();
        $input = $this->standardized($input, $crazy);
        $crazy = $this->update($input, $crazy->id);
        if (isset($input['sentences'])) {
            $this->detailUpdate($input, $crazy);
        }
        return $crazy;
    }

    private function detailUpdate($input, $crazy)
    {
        $no = 0;
        $detailIds = [];
        if (isset($input['sentences'])) {
            foreach ($input['sentences'] as $detailId => $sentence) {
                $data = [
                    'no' => ++$no,
                    'time' => $input['times'][$detailId],
                    'sentence' => $sentence,
                    'meaning' => $input['meanings'][$detailId],
                    'is_active' => 1,
                ];
                if ((int)($detailId) === 0) {
                    $newCrazy = $crazy->details()->create($data);
                    $detailIds[] = $newCrazy->id;
                } else {
                    app(CrazyDetailRepositoryEloquent::class)
                        ->update($data, $detailId);
                    $detailIds[] = $detailId;
                }
            }
            $this->deleteDetails($crazy, $detailIds);
            unset($input['sentences']);
            unset($input['meanings']);
        }
    }

    private function deleteDetails($crazy, $detailIds)
    {
        $crazy->details()
            ->whereNotIn('id', $detailIds)
            ->delete();
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
