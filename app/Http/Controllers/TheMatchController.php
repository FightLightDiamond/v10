<?php

namespace App\Http\Controllers;

use App\Http\Services\TheMatchService;
use Illuminate\Http\Request;

class TheMatchController extends Controller
{
    public function __construct(protected TheMatchService $theMatchService)
    {

    }

    public function index()
    {
        return $this->theMatchService->paginate();
    }

    public function current()
    {
        return $this->theMatchService->getCurrent();
    }
}
