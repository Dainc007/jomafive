<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\GenerateFixtureService;
use App\Models\Admin\Fixture;
use App\Models\Admin\PlayerStats;
use App\Models\Admin\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FixturesController extends Controller
{
    public function add(Request $request)
    {
        if (isset($request['generate'])) {
            /* connecting teams together */
            $firstTeamTable = DB::table('league_tables')
                ->select(['id', 'teamname', 'teamID'])
                ->where('competitionID', $request['competitionID']);

            $secondTeamTable = DB::table('league_tables AS T2')
                ->select([
                    'T2.teamname AS hosts', 'league_tables.teamname AS visitors', 'T2.teamID AS hostsID',
                    'league_tables.teamID as visitorsID'
                ])
                ->joinSub($firstTeamTable, 'league_tables', function ($join) {
                    $join->on('league_tables.id', '<', 'T2.id');
                })
                ->where('competitionID', $request['competitionID'])
                ->get()
                ->shuffle();
            $secondTeamTable->toArray();

            /* formating date and time */

            $startDate = $request['startDate'];
            $startDate = Carbon::createFromDate($startDate);

            $startTime = $request['startTime'];
            $startTime = Carbon::createFromTimeString($request['startTime']);

            $beginTime = $request['startTime'];
            $beginTime = Carbon::createFromTimeString($request['startTime']);


            $endTime = $request['endTime'];
            $endTime = Carbon::createFromTimeString($request['endTime']);

            return  view('fixtures.add', [
                'teams' => DB::table('league_tables')->where('competitionID', $request['competitionID'])->get(),
                'fixtures' => $secondTeamTable,
                'competitionID' => $request['competitionID'],
                'request' => $request,
                'start' => 'działa',
                'startDate' => $startDate,
                'startTime' => $startTime,
                'beginTime' => $beginTime,
                'endTime' => $endTime,


            ]);
        } else {
            return view('fixtures.add', ['competitionID' => $request['competitionID']]);
        }
    }

    public function store(Request $request)
    {
        if ($request->has('hosts')) {

            for ($i = 0; $i < count($request['competitionID']);) {

                $x = DB::table('fixtures')->insert([
                    'competitionID' => $request->competitionID[$i],
                    'hosts' => $request->hosts[$i],
                    'hostsID' => $request->hostsID[$i],
                    'visitors' => $request->visitors[$i],
                    'visitorsID' => $request->visitorsID[$i],
                    'pitch' => $request->pitch[$i],
                    'date' => $request->date[$i],
                    'hour' => $request->time[$i],
                ]);
                $i++;
            }
        }

        return redirect(route('articles'));
    }

    public function edit()
    {
    }

    public function delete()
    {
    }

    public function show()
    {
    }
    //przeniesione jako show w playerStatsController
    public function gameShow(int $competitionID, int $gameID)
    {
        $game = Fixture::where('id', $gameID)->first();

        //to wszystko działa.

        return view('games.show', [
            'game' => $game,
            'hosts' => PlayerStats::join('players', function ($join) {
                $join->on('player_stats.playerID', '=', 'players.id');
            })
                ->get(['players.name as name', 'players.surname as surname', 'player_stats.teamName as teamName', 'player_stats.apperiance as apperiance', 'player_stats.gameID as gameID'])
                ->where('teamName', $game['hosts'])
                ->where('apperiance', true)
                ->where('gameID', $gameID),
            'visitors' => PlayerStats::join('players', function ($join) {
                $join->on('player_stats.playerID', '=', 'players.id');
            })
                ->get(['players.name as name', 'players.surname as surname', 'player_stats.teamName as teamName', 'player_stats.apperiance as apperiance', 'player_stats.gameID as gameID'])
                ->where('teamName', $game['visitors'])
                ->where('apperiance', true)
                ->where('gameID', $gameID),
            'goals' => PlayerStats::join('players', function ($join) {
                $join->on('player_stats.playerID', '=', 'players.id');
            })
                ->orderBy('player_stats.minute', 'ASC')
                ->get([
                    'players.name as name', 'players.surname as surname', 'player_stats.teamName as teamName',
                    'player_stats.gameID as gameID', 'player_stats.apperiance as apperiance', 'player_stats.goal as goal',
                    'player_stats.assistantID as assistantID', 'player_stats.minute as minute'
                ])
                ->where('gameID', $gameID)
                ->where('apperiance', false)

        ]);
    }

    public function generateFixture(Request $request)
    {
        $teams = DB::table('junior_league_tables')->where('competitionID', $request->id)->where('stage', $request->stage)->pluck('teamName')->toArray();
        /* Need to add date and time generator and validator if fixure exist */
        /* Next is form to enter scores and automaticly getting a level highter or lower */
        $params = [];
        $params['date'] = today()->format('Y-m-d');
        $params['hour'] = '20:30';
        $params['competitionID'] = $request->id;
        $params['stage'] = $request->stage;
        foreach ((new GenerateFixtureService($teams))->fixtures as $key => $matchday) {
            $params['round'] = $key +1;
            foreach ($matchday as $team) {
                $params['hosts'] = $team['host'];
                $params['visitors'] = $team['visitor'];
            }
            DB::table('junior_fixtures')->insert($params);
        };
    }
}
