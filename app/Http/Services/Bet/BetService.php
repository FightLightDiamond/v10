<?php

namespace App\Http\Services\Bet;

use App\Const\BetStatusConstant;
use App\Repositories\BetRepository;
use App\Repositories\TheMatchRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class BetService
{
    public function __construct(
        protected BetRepository $betRepository,
        protected TheMatchRepository $theMatchRepository,
        protected UserRepository $userRepository,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function bet(array $data)
    {
        $bet = $this->findAndCheckBet($data);

        $this->checkMatch($data['match_id']);

        return DB::transaction(
            function () use ($data, $bet) {
                $user = $this->getUserAndCheckBalance($data['user_id'], $data['balance']);
                $user->decrement('balance', $data['balance']);
                $bet->save();
            }
        );
    }

    /**
     * @throws \Exception
     */
    protected function getUserAndCheckBalance($userId, $balance)
    {
        $user = $this->userRepository->firstLock($userId);

        if ($user->balance < $balance) {
            throw new \Exception('Balance not enough', 400);
        }

        return $user;
    }

    /**
     * @throws \Exception
     */
    protected function findAndCheckBet($data)
    {
        $bet = $this->betRepository->firstOrNew($data);
        if ($bet->id) {
            throw new \Exception('The match had bet', 400);
        }
        return $bet;
    }

    /**
     * @throws \Exception
     */
    protected function checkMatch($match_id): void
    {
        $match = $this->theMatchRepository->find($match_id);

        if ($match->status !== BetStatusConstant::BETTING) {
            throw new \Exception('Match illegal', 400);
        }
    }
}
