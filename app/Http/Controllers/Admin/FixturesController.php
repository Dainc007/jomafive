<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\GenerateFixtureService;
use App\Http\Services\LeagueTableService;
use App\Models\Admin\Fixture;
use App\Models\Admin\JuniorLeagueTable;
use App\Models\Admin\PlayerStats;
use App\Models\JuniorFixture;
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
        /* checking if fixture already exist */
        $fixtureExist = JuniorFixture::where('competitionID', $request->id)->where('stage', $request->stage)->first();

        if ($fixtureExist !== null) {
            return 'Fixture Already Exist';
            die;
        }

        $teams = JuniorLeagueTable::where('competitionID', $request->id)
            ->where('stage', $request->stage)->get();

        $groups = [
            $teams->where('group', 1)->pluck('teamName')->toArray(),
            $teams->where('group', 2)->pluck('teamName')->toArray(),
            $teams->where('group', 3)->pluck('teamName')->toArray(),
        ];

        $details = [
            'competitionId' => $request->id,
            'startDate'     => $request->startDate,
            'firstGameHour' => $request->firstGameHour,
            'lastGameHour'  => $request->lastGameHour,
            'gameDuration'  => $request->gameDuration,
            'numOfPitches'  => $request->numOfPitches,
            'stage'         => $request->stage,

        ];

        foreach ($groups as $group) {
            $schedule =  GenerateFixtureService::generateMeetingsWithSchedule($group, $details);
            foreach ($schedule as $round => $games) {
                /* echo 'runda: ' . $round + 1 . '<br>'; */
                foreach ($games as $game) {

                    JuniorFixture::insert($game);
                }
            }
        }

        return back();
    }

    public function form(Request $request)
    {
        $games = array_chunk($request->game, 3);

        foreach ($games as $game) {
            if ($game[1] !== null) {
                $fixture = JuniorFixture::find($game[0]);

                /* checking if score has been set earlier */
                if ($fixture->hosts_goals !== null) {
                    continue;
                }

                $fixture->hosts_goals = $game[1];
                $fixture->visitors_goals = $game[2];
                $fixture->save();

                /* Updating League Table */

                $data = [
                    'hosts'          => $fixture->hosts,
                    'visitors'       => $fixture->visitors,
                    'hosts_goals'    => $game[1],
                    'visitors_goals' => $game[2],
                    'competitionId'  => $fixture->competitionID,
                    'stage'          => $fixture->stage,
                ];

                LeagueTableService::update($data);
            }
        }

        return back();
    }
}
