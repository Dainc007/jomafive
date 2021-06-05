<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Competition;
use App\Models\Admin\Fixture;
use App\Models\Admin\JuniorCompetition;
use App\Models\Admin\LeagueTable;
use App\Models\Admin\Team;
use App\Models\Admin\JuniorTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompetitionController extends Controller
{
    public function index()
    {
        return view('competitions.index', [
            'competitions' => Competition::all(),
            'junior_competitions' => JuniorCompetition::all(),
        ]);
    }

    public function add(Request $request)
    {

        if (isset($request['showSeniorTeams'])) {

            return view('competitions.add', [
                'teams' => DB::table('teams')->where('league', $request['league'])->where('level', $request['level'])->get('name', 'id'),
                'request' => $request,
            ]);
        }

        if (isset($request['showJuniorTeams'])) {

            return view('competitions.add', [
                'teams' => DB::table('junior_teams')->where('class', $request['class'])->get(),
                'request' => $request,
            ]);
        }



        return view('competitions.add');
    }

    public function store(Request $request)
    {

        if ($request['class'] > 0) {
            $competitionID = DB::table('junior_competitions')->insertGetId(
                [
                    'start' => now(),
                    'class' => $request['class'],
                ]
            );

            foreach ($request['pickedTeams'] as $teamName) {
                $teamID = JuniorTeam::where('name', $teamName)->where('class', $request['class'])->value('id');
                for ($i = 1; 4 > $i; $i++) {
                    DB::table('junior_league_tables')->insert([
                        'teamName' => $teamName,
                        'competitionID' => $competitionID,
                        'teamID' => $teamID,
                        'level' => JuniorTeam::where('id', $teamID)->value('level'),
                        'stage' => $i,
                    ]);
                }
            }

            return redirect(
                route(
                    'competitions.juniorShow',
                    [
                        'id' => $competitionID
                    ]
                )
            );
        } else {
            $competitionID = DB::table('competitions')->insertGetId(
                [
                    'start' => now(),
                    'league' => $request['league'],
                    'level' => $request['level'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            foreach ($request['pickedTeams'] as $teamName) {
                DB::table('league_tables')->insert([
                    'teamName' => $teamName,
                    'competitionID' => $competitionID,
                    'teamID' => Team::where('name', $teamName)->value('id')
                ]);
            }
        }

        return redirect(
            route(
                'competitions.show',
                [
                    'id' => $competitionID
                ]
            )
        );
    }

    public function show(Request $request, int $id)
    {
        $firstTeamTable = DB::table('league_tables')
            ->select(['id', 'teamname'])
            ->where('competitionID', $id);

        $secondTeamTable = DB::table('league_tables AS T2')
            ->select(['T2.teamname AS hosts', 'league_tables.teamname AS visitors'])
            ->joinSub($firstTeamTable, 'league_tables', function ($join) {
                $join->on('league_tables.id', '<', 'T2.id');
            })
            ->get()
            ->shuffle();

        $secondTeamTable->toArray();

        return  view('leagueTables.show', [
            'teams' => DB::table('league_tables')->where('competitionID', $id)
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),
            'juniorTeams' => DB::table('junior_league_tables')->where('competitionID', $id)
                ->orderBy('level', 'ASC')
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),
            'fixtures' => $secondTeamTable,
            'competitionID' => $id,
            'start' => '',
            'games' => DB::table('fixtures')->where('competitionID', $id)->get(),
        ]);
    }

    public function juniorShow(Request $request, int $id)
    {
        return  view('leagueTables.juniorShow', [
            'juniorTeams' => DB::table('junior_league_tables')->where('competitionID', $id)
                ->select('level', 'teamId', 'teamName', DB::raw(
                    'SUM(points) as points, SUM(bilans) as bilans, SUM(games) as games, SUM(wins) as wins,
                    SUM(draws) as draws, SUM(losts) as losts'
                ))
                ->groupBy('teamId', 'level', 'teamName')
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC') 
                ->get(),

            'stage1' => DB::table('junior_league_tables')->where('competitionID', $id)->where('stage', 1)
                ->orderBy('level', 'ASC')
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),

            'stage2' => DB::table('junior_league_tables')->where('competitionID', $id)->where('stage', 2)
                ->orderBy('level', 'ASC')
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),

            'stage3' => DB::table('junior_league_tables')->where('competitionID', $id)->where('stage', 3)
                ->orderBy('level', 'ASC')
                ->orderBy('points', 'DESC')
                ->orderBy('bilans', 'DESC')
                ->get(),
            'competitionID' => $id,
            'junior_games' => DB::table('junior_fixtures')->where('competitionID', $id)->get()
        ]);
    }
}
