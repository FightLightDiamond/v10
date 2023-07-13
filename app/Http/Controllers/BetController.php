<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetRequest;
use App\Http\Services\BetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{

    public function __construct(protected BetService $betService)
    {
    }
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
