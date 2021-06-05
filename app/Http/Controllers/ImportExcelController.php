<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\JuniorFixtureImport;
use App\Models\Admin\JuniorLeagueTable;
use App\Models\JuniorFixture;

class ImportExcelController extends Controller
{
    function index()
    {
        $data = DB::table('junior_fixtures')->orderBy('id', 'DESC')->get();

        return view('test', ['data' => $data]);
    }

    public function import(Request $request, int $competitionID)
    {
        Excel::import(new JuniorFixtureImport, request()->file('select_file'));

       $games = JuniorFixture::where('competitionID', $competitionID)->where('stage', $request['stage'])->get();

      
     
         foreach ($games as $game) {
            //update league Table

            $homeTeam = JuniorLeagueTable::where('competitionID', $game['competitionID'])
                ->where('teamName', $game['hosts'])->where('stage', $game['stage']);

            $awayTeam = JuniorLeagueTable::where('competitionID', $game['competitionID'])
                ->where('teamName', $game['visitors'])->where('stage', $game['stage']);

            //adding games
            $homeTeam->increment('games');
            $awayTeam->increment('games');

            $homeTeam->increment('goals_scored', $game['hosts_goals']);
            $homeTeam->increment('goals_lost', $game['visitors_goals']);
            $homeTeam->update(['bilans' => DB::raw('goals_scored - goals_lost')]);

            $awayTeam->increment('goals_scored', $game['visitors_goals']);
            $awayTeam->increment('goals_lost', $game['hosts_goals']);
            $awayTeam->update(['bilans' => DB::raw('goals_scored - goals_lost')]);

            //hosts wins
            if ($game['hosts_goals'] > $game['visitors_goals']) {

                $homeTeam->increment('wins');
                $homeTeam->increment('points', 3);

                $awayTeam->increment('losts');

                //visitors wins
            } elseif ($game['hosts_goals'] < $game['visitors_goals']) {

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
        }
    

        return back(); 

    }
}
