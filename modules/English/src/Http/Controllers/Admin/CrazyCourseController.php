<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\CrazyCourseCreateRequest;
use English\Http\Requests\CrazyCourseUpdateRequest;
use English\Http\Repositories\CrazyCourseRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modularization\MultiInheritance\ControllersTrait;

class CrazyCourseController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazyCourses'] = $this->repository
            ->myPaginate($input);
        return Inertia::render('Admin/English/Course/Index', $data);
    }

    public function create()
    {
        return Inertia::render('Admin/English/Course/Update');
    }

    public function store(CrazyCourseCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        return redirect()->route('admin.crazy-courses.index');
    }

    public function show($id)
    {
        $data['course'] = $this->repository->edit($id);
        return Inertia::render('Admin/English/Course/Update', $data);
    }

    public function edit($id)
    {
        $data['course'] = $this->repository->edit($id);
        return Inertia::render('Admin/English/Course/Update', $data);
    }

    public function update(CrazyCourseUpdateRequest $request, $id)
    {
        $input = $request->all();
        $this->repository->update($input, $id);
        return redirect()->route('admin.crazy-courses.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return back();
    }
}
