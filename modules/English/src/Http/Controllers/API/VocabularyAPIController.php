<?php

namespace English\Http\Controllers\API;

use English\Http\Repositories\VocabularyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VocabularyAPIController extends Controller
{
    private VocabularyRepository $repository;

    public function __construct(VocabularyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function import(Request $request)
    {
        $file = $request->all()[0];
        $this->repository->import($file);
        if ($request->ajax()) {
            return response()->json('Import success');
        }
        session()->flash('success', 'Import success');
        return back();
    }

    public function export(Request $request)
    {
        $params = $request->all();
        $this->repository->export($params);
    }
}
