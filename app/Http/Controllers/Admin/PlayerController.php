<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function players(int $id)
    {
        return view('teams.player', [
            'players' => DB::table('players')->orderBy('id', 'DESC')->limit(20)->get(),
            'juniors' => DB::table('junior_players')->orderBy('id', 'DESC')->limit(20)->get(),
            'showPlayer' => DB::table('players')->where('id', $id)->get(),
            'showJunior' => DB::table('junior_players')->where('id', $id)->get()
        ]);
    }

    public function managers(int $id)
    {
        return view('teams.manager', [
            'managers' => DB::table('managers')->orderBy('id', 'DESC')->limit(10)->get(),
            'showManager' => DB::table('managers')->where('id', $id)->get(),
        ]);
    }

    public function transferList(Request $request)
    {

        return view('teams.transferList', [
            'confirmedPlayers' => DB::table('players')->where('teamName', 'TransferList')->where('confirmed', true)->get(),
            'notConfirmedPlayers' => DB::table('players')->where('teamName', 'TransferList')->where('confirmed', false)->get(),

        ]);
    }

    public function add(Request $request)
    {
        if ($request->has('id')) {

            if ($request->has('reject')) {
                $player = DB::table('players')->where('id', $request->id)->delete();
            }

            if ($request->has('accept')) {
                $player = DB::table('players')->where('id', $request->id)->update(['confirmed' => 1]);
            }
        }

        if ($request->has('surname')) {
            $player = Player::create($request->all());
        }


        return back();
    }
}
