<?php

namespace App\Http\Controllers;

use App\Http\Services\ChartsService;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function __construct(protected ChartsService $chartsService)
    {
    }

    public function getChartsGold()
    {
        return $this->chartsService->getChartsGold();
    }
}
