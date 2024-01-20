<?php

namespace English\Http\Controllers;

use App\Http\Controllers\Controller;
use English\Http\Services\EnglishService;
use Inertia\Inertia;


class EnglishController extends Controller
{
    private EnglishService $englishService;

    public function __construct(EnglishService $englishService)
    {
        $this->englishService = $englishService;
    }

    public function index()
    {
        try {
            $data = $this->englishService->overview();
            return Inertia::render('Admin/English/Index', $data);
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return back();
        }
    }
}
