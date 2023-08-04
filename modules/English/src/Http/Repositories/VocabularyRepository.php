<?php

namespace English\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VocabularyRepository
 *
 * @package namespace App\Repositories;
 */
interface VocabularyRepository extends RepositoryInterface
{
    public function myPaginate($params);
    public function store($params);
    public function change($params, $data);
    public function destroy($data);
}
