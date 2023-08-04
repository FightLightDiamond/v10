<?php

namespace Tutorial\Http\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 *
 * @package namespace App\Repositories;
 */
interface SectionRepository extends RepositoryInterface
{
    public function myPaginate($params);
    public function store($params);
    public function change($params, $data);
    public function destroy($id);
    public function edit($id);
}
