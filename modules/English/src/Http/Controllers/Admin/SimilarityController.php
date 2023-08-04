<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use English\Models\Similarity;
use English\Http\Requests\SimilarityCreateRequest;
use English\Http\Requests\SimilarityUpdateRequest;
use English\Http\Repositories\SimilarityRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class SimilarityController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(SimilarityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $data['similarities'] = $this->repository->myPaginate($params);
        if ($request->ajax()) {
            return view('en::admin.similarity.table', $data)->render();
        }
        return view('en::admin.similarity.index', $data);
    }

    public function create()
    {
        return view('en::admin.similarity.create');
    }

    public function store(SimilarityCreateRequest $request)
    {
        $params = $request->all();
        $this->repository->store($params);
        session()->flash('success', 'create success');
        return redirect()->route('admin.similarities.index');
    }

    public function show($id)
    {
        $similarity = $this->repository->find($id);
        if (empty($similarity)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.similarity.show', compact('similarity'));
    }

    public function edit($id)
    {
        $similarity = $this->repository->find($id);
        if (empty($similarity)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.similarity.update', compact('similarity'));
    }

    public function update(SimilarityUpdateRequest $request, $id)
    {
        $params = $request->all();
        $similarity = $this->repository->find($id);
        if (empty($similarity)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($params, $similarity);
        session()->flash('success', 'update success');
        return redirect()->route('admin.similarities.index');
    }

    public function destroy($id)
    {
        $similarity = $this->repository->find($id);
        if (empty($similarity)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
