<?php

namespace English\Http\Repositories;

use Cuongpm\Modularization\MultiInheritance\RepositoryInterfaceExtra;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 *
 * @package namespace App\Repositories;
 */
interface CrazyDetailRepository extends RepositoryInterface, RepositoryInterfaceExtra
{
    public function myPaginate($params);

    public function store($params);

    public function change($params, $data);

    public function delete($id);
}
