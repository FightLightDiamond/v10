<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Modularization\Facades\InputFa;
use English\Models\CrazyDetail;
use English\Http\Requests\CrazyDetailCreateRequest;
use English\Http\Requests\CrazyDetailUpdateRequest;
use English\Http\Repositories\CrazyDetailRepository;
use Illuminate\Http\Request;
use Modularization\MultiInheritance\ControllersTrait;

class CrazyDetailController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyDetailRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazy_details'] = $this->repository->myPaginate($input);
        return Inertia::render('Admin/English/CrazyDetail/Update', $data);
    }

    public function create()
    {
        return Inertia::render('Admin/English/CrazyDetail/Update');
    }

    public function store(CrazyDetailCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        return redirect()->route('admin.crazies.detail.index');
    }

    public function show($id)
    {
        $data['crazy_detail'] = $this->repository->find($id);
        return Inertia::render('Admin/English/CrazyDetail/Show', $data);
    }

    public function edit($id)
    {
        $data['crazy_detail'] = $this->repository->find($id);
        return Inertia::render('Admin/English/CrazyDetail/Show', $data);
    }

    public function update(CrazyDetailUpdateRequest $request, $id)
    {
        $input = $request->all();
        $this->repository->update($input, $id);
        return redirect()->route('admin.crazies.detail.index');
    }

    public function destroy($id)
    {
        $res = $this->repository->delete($id);
        if($res) {
            session()->flash('success', 'delete success');
        } else {
            session()->flash('error', 'delete fails');
        }

        return back();
    }
}
