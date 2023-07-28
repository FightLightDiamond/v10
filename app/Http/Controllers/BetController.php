<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetRequest;
use App\Http\Services\Bet\BetService;
use App\Http\Services\TheMatchService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BetController extends Controller
{
    public function __construct(protected BetService $betService,
    protected TheMatchService $theMatchService
    )
    {
    }

    public function index(): \Inertia\Response
    {
        $currentMatch = $this->theMatchService->getCurrent();
        return Inertia::render('index', compact('currentMatch'));
    }

    /**
     * @throws Exception
     */
    public function execute(BetRequest $request)
    {
        return $this->betService->bet(
            [
            ...$request->all(),
            'user_id' => Auth::id()
            ]
        );
    }
}
