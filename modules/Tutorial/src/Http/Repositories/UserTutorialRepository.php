<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoryInterfaceExtra;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserTutorialRepository
 *
 * @package namespace App\Repositories;
 */
interface UserTutorialRepository extends RepositoryInterface, RepositoryInterfaceExtra
{
    public function myPaginate($params);

    public function store($params);

    public function change($params, $data);

    public function delete($id);

    public function import($file);
}
