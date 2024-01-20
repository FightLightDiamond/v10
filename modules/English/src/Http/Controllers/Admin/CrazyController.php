<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\CrazyCreateRequest;
use English\Http\Requests\CrazyUpdateRequest;
use English\Http\Repositories\CrazyRepository;
use English\Models\CrazyCourse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modularization\MultiInheritance\ControllersTrait;

class CrazyController extends Controller
{
    use ControllersTrait;
    private CrazyRepository $repository;

    public function __construct(CrazyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $data['crazies'] = $this->repository->myPaginate($input);
        $data['courses'] = CrazyCourse::query();

        return Inertia::render('Admin/English/Crazy/Index', $data);
    }

    public function create()
    {
        $data['courses'] = CrazyCourse::query();
        return Inertia::render('Admin/English/Crazy/Create', $data);
    }

    public function store(CrazyCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        return redirect()->route('admin.crazies.index');
    }

    public function show($id)
    {
        $crazy = $this->repository->find($id);
        return Inertia::render('Admin/English/Crazy/Show', compact('crazy'));
    }

    public function edit($id)
    {
        $crazy = $this->repository->edit($id);
        return Inertia::render('Admin/English/Crazy/Update', compact('crazy'));
    }

    public function update(CrazyUpdateRequest $request, $id)
    {
        $input = $request->all();

        $this->repository->update($input, $id);
        return redirect()->route('admin.crazies.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return back();
    }
}
