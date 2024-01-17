<?php

namespace English\Http\Repositories;

use Modularization\MultiInheritance\ExtraRepositoryInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 * @package namespace App\Repositories;
 */
interface CrazyCourseRepository extends RepositoryInterface
{
    public function myPaginate($input);

    public function store($input);

    public function change($input, $data);

    public function delete($data);

//    public function getList($id);
}
