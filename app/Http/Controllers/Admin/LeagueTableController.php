<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Competition;
use App\Models\Admin\JuniorLeagueTable;
use App\Models\Admin\LeagueTable;
use App\Models\JuniorFixture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueTableController extends Controller
{
    public function index()
    {
        return view('leagueTables.index');
    }

    public function add()
    {
        return view('leagueTables.add');
    }

    public function store()
    {
        return 'nothing';
    }

    public function show(Competition $competitionID)
    {
        return view('leagueTables.show', [

            'tables' => DB::table('league_tables')->where('competitionID', $competitionID)->pluck('teamName')
        ]);
    }

    public function updateTable(Request $request)
    {
        
    }
}
