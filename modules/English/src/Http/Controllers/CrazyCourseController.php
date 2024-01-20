<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 10/4/18
 * Time: 8:26 PM
 */

namespace English\Http\Controllers;

use English\Http\Repositories\CrazyCourseRepository;
use Inertia\Inertia;

class CrazyCourseController
{

    private CrazyCourseRepository $repository;

    public function __construct(CrazyCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getList($id)
    {
        $data = $this->repository->getList($id);

        return Inertia::render('English/Course/Index', $data);
    }
}
