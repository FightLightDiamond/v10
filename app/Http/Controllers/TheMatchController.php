<?php

namespace App\Http\Controllers;

use App\Http\Services\TheMatchService;
use Exception;
use Illuminate\Support\Facades\DB;

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
        try {
            return $this->theMatchService->getCurrent();
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function statistic(string $orderBy): array
    {
        $oderByArr = ['lose_num', 'total', 'percent', 'win_num'];
        $orderQuery = "";
        if (in_array($orderBy, $oderByArr)) {
            $orderQuery = "order by {$orderBy}";
        }

        $query = "with win_table as (SELECT count(id) as win, winner FROM bet_herox.matches group by winner order by win),
             lose_table as (SELECT count(id) as lose, loser FROM bet_herox.matches group by loser order by lose)
             select id, name, win, lose, (win/lose) as percent, (win + lose) as total
             from bet_herox.heroes
             left join lose_table on heroes.id = lose_table.loser
             left join win_table on heroes.id = win_table.winner {$orderQuery}";

        return DB::select($query);
    }

    public function statisticOne(int $id, string $orderBy): array
    {
        $oderByArr = ['lose_num', 'total', 'percent', 'win_num'];
        $orderQuery = "";
        if (in_array($orderBy, $oderByArr)) {
            $orderQuery = "order by {$orderBy}";
        }
        $query = "with win_table as (SELECT  count(id) as lose_num, loser, winner FROM bet_herox.matches where loser = {$id} group by winner),
            lose_table as (SELECT  count(id) as win_num, loser, winner FROM bet_herox.matches where winner = {$id} group by loser),
            hero_table as (SELECT id, name from bet_herox.heroes where id != {$id})
            select id, name, win_num, lose_num, (win_num/lose_num) as percent, (win_num + lose_num) as total
            from hero_table
            left join lose_table on hero_table.id = lose_table.loser
            left join win_table on hero_table.id = win_table.winner
         {$orderQuery}`";
        return DB::select($query);
    }
}
