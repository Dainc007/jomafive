<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Fixture;
use App\Models\Admin\LeagueTable;
use App\Models\Admin\Player;
use App\Models\Admin\PlayerStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerStatsController extends Controller
{
    public function index()
    {
        return view('stats.index', [
            'games' => Fixture::where('date', '<=', now())
                ->where('hosts_goals', null)
                ->OrderBy('date', 'ASC')
                ->OrderBy('competitionID', 'ASC')
                ->get()
        ]);
    }

    public function add(int $id)
    {
        $fixture = Fixture::where('id', $id)->first();

        return view('stats.add', [
            'fixture'  => $fixture,
            'hosts'    => Player::where('teamID', $fixture['hostsID'])->get(['id', 'name', 'surname']),
            'visitors' => Player::where('teamID', $fixture['visitorsID'])->get(['id', 'name', 'surname'])
        ]);
    }

    public function edit()
    {
        return view('stats.add');
    }

    public function store(Request $request)
    {
        //set score
        $update = Fixture::where('id', $request['gameID'])->update([
            'hosts_goals'    => $request['hosts_goals'],
            'visitors_goals' => $request['visitors_goals']
        ]);

        //update league Table

        $homeTeam = LeagueTable::where('competitionID', $request['competitionID'])
            ->where('teamId', $request['hostsID']);

        $awayTeam = LeagueTable::where('competitionID', $request['competitionID'])
            ->where('teamId', $request['visitorsID']);

        $homeTeam->increment('games');
        $awayTeam->increment('games');

        $homeTeam->increment('goals_scored', $request['hosts_goals']);
        $homeTeam->increment('goals_lost', $request['visitors_goals']);
        $homeTeam->update(['bilans' => DB::raw('goals_scored - goals_lost')]);

        $awayTeam->increment('goals_scored', $request['visitors_goals']);
        $awayTeam->increment('goals_lost', $request['hosts_goals']);
        $awayTeam->update(['bilans' => DB::raw('goals_scored - goals_lost')]);



        //hosts wins
        if ($request['hosts_goals'] > $request['visitors_goals']) {

            $homeTeam->increment('wins');
            $homeTeam->increment('points', 3);

            $awayTeam->increment('losts');

            //visitors wins
        } elseif ($request['hosts_goals'] < $request['visitors_goals']) {

            $awayTeam->increment('wins');
            $awayTeam->increment('points', 3);

            $homeTeam->increment('losts');

            //its a draw
        } else {

            $homeTeam->increment('draws');
            $homeTeam->increment('points');

            $awayTeam->increment('draws');
            $awayTeam->increment('points');
        }

        //add players apperiance
        //hosts
        if ($request->has('hostsPlayers')) {

            for ($i = 0; $i < count($request['hostsPlayers']);) {

                $hosts = PlayerStats::insert([
                    'teamName' => $request->hosts,
                    'teamID' => $request->hostsID,
                    'gameID' => $request->gameID,
                    'apperiance' => true,
                    'playerID' => $request->hostsPlayers[$i],
                    'competitionID' => $request->competitionID
                ]);
                $i++;
            }
        }

        //visitos
        if ($request->has('visitorsPlayers')) {

            for ($i = 0; $i < count($request['visitorsPlayers']);) {

                $visitors = PlayerStats::insert([
                    'teamName' => $request->visitors,
                    'teamID' => $request->visitorsID,
                    'gameID' => $request->gameID,
                    'apperiance' => true,
                    'playerID' => $request->visitorsPlayers[$i],
                    'competitionID' => $request->competitionID
                ]);
                $i++;
            }
        }

        //add game statistics
        //hosts

        if ($request->has('hostsG')) {

            for ($i = 0; $i < $request['hosts_goals'];) {

                $hostsG = PlayerStats::insert([
                    'teamName' => $request->hosts,
                    'teamID' => $request->hostsID,
                    'gameID' => $request->gameID,
                    'playerID' => $request->hostsG[$i],
                    'goal'    => true,
                    'assistantID' => $request->hostsA[$i],
                    'minute' => $request->minutes[$i],
                    'competitionID' => $request->competitionID
                ]);
                    //adding assists
                if ($request->hostsA[$i] > 0) {
                    $assistant = PlayerStats::insert([
                        'teamName' => $request->hosts,
                        'teamID' => $request->hostsID,
                        'gameID' => $request->gameID,
                        'playerID' => $request->hostsA[$i],
                        'goal' => false,
                        'minute' => $request->minutes[$i],
                        'assist' => true,
                        'competitionID' => $request->competitionID
                    ]);
                }

                $i++;
            }
        }

        if ($request->has('visitorsG')) {

            for ($i = 0; $i < $request['visitors_goals'];) {

                $visitorsG = PlayerStats::insert([
                    'teamName' => $request->visitors,
                    'teamID' => $request->visitorsID,
                    'gameID' => $request->gameID,
                    'playerID' => $request->visitorsG[$i],
                    'goal'    => true,
                    'assistantID' => $request->visitorsA[$i],
                    'minute' => $request->minutes[$i],
                    'competitionID' => $request->competitionID

                ]);
                //adding assists
                if ($request->visitorsA[$i] > 0) {
                    $assistant = PlayerStats::insert([
                        'teamName' => $request->visitors,
                        'teamID' => $request->visitorsID,
                        'gameID' => $request->gameID,
                        'playerID' => $request->visitorsA[$i],
                        'goal' => false,
                        'minute' => $request->minutes[$i],
                        'assist' => true,
                        'competitionID' => $request->competitionID
                    ]);
                }

                $i++;
            }
        }

        return redirect(
            route('fixtures.gameShow', [
                'gameID' => $request['gameID'],
                'competitionID' => $request['competitionID']
            ])
        );
    }
}
