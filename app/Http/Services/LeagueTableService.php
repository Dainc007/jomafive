<?php

namespace App\Http\Services;

use App\Models\Admin\JuniorLeagueTable;
use App\Models\JuniorFixture;

class LeagueTableService
{
    public $hosts;
    public $visitors;
    public $hostsGoals;
    public $visitorsGoals;

    public static function update(array $gameResult)
    {
        $hosts    = self::getHosts($gameResult['competitionId'], $gameResult['hosts'], $gameResult['stage']);
        $visitors = self::getVisitors($gameResult['competitionId'], $gameResult['visitors'], $gameResult['stage']);

        self::checkResult($gameResult['hosts_goals'], $gameResult['visitors_goals'], $hosts, $visitors);
        self::addPlayedGames($hosts, $visitors);
        self::addGoals($gameResult['hosts_goals'], $gameResult['visitors_goals'], $hosts, $visitors);
        self::save($hosts, $visitors);
    }

    private static function checkResult($hostGoals, $visitorsGoals, $hosts, $visitors)
    {
        if ($hostGoals == $visitorsGoals) {
            return self::addPointsToBoth($hosts, $visitors);
        }

        if ($hostGoals > $visitorsGoals) {
            return self::addPointsToHosts($hosts, $visitors);
        } else {
            return self::addPointsToVisitors($hosts, $visitors);
        }
    }

    private static function addPointsToHosts($hosts, $visitors)
    {
        $hosts->wins++;
        $hosts->points = $hosts->points + 3;
        $visitors->losts++;
    }

    private static function addPointsToVisitors($hosts, $visitors)
    {
        $hosts->losts++;
        $visitors->wins++;
        $visitors->points = $visitors->points + 3;
    }

    private static function addPointsToBoth($hosts, $visitors)
    {
        $hosts->draws++;
        $hosts->points++;

        $visitors->draws++;
        $visitors->points++;
    }

    private static function addPlayedGames($hosts, $visitors)
    {
        $hosts->games++;
        $visitors->games++;
    }

    private static function getHosts($id, $hostsName, $stage)
    {
        $hosts = JuniorLeagueTable::where('competitionID', $id)
            ->where('teamName', $hostsName)
            ->where('stage', $stage)->first();
        return $hosts;
    }

    private static function getVisitors($id, $visitorsName, $stage)
    {
        $visitors = JuniorLeagueTable::where('competitionID', $id)
            ->where('teamName', $visitorsName)
            ->where('stage', $stage)->first();

        return $visitors;
    }

    private static function addGoals($hostsGoals, $visitorsGoals, $hosts, $visitors)
    {
        $hosts->goals_scored = $hosts->goals_scored + $hostsGoals;
        $hosts->goals_lost   = $hosts->goals_lost + $visitorsGoals;

        $visitors->goals_scored = $visitors->goals_scored + $visitorsGoals;
        $visitors->goals_lost   = $visitors->goals_lost + $hostsGoals;

        $hosts->bilans    = $hosts->goals_scored - $hosts->goals_lost;
        $visitors->bilans = $visitors->goals_scored - $visitors->goals_lost;
    }

    private static function save($hosts, $visitors)
    {
        $hosts->save();
        $visitors->save();
    }

    public static function teamToPromote($teams)
    {
        $firstTeam   = $teams->first();
        $equalTeams  = $teams->where('points', $firstTeam['points']);

        if ($equalTeams->count() == 1) {
            return $firstTeam;
        }

        if ($equalTeams->count() == 2) {
            $secondTeam = $equalTeams->where('teamId', '!=', $firstTeam->teamId)->first();

            $game   = self::getGame($firstTeam, $secondTeam, $firstTeam->competitionID, $firstTeam->stage);

            if ($game !== null) {
                $winner = self::getWinner($game);
                if ($winner !== false) {
                    $winner = $teams->where('teamName', $winner)->first();
                    return $winner;
                }
            }
        }
    }

    public static function teamToReleagate($teams)
    {
        $firstTeam   = ($teams->reverse())->first();
        $equalTeams  = $teams->where('points', $firstTeam['points']);

        if ($equalTeams->count() == 1) {
            return $firstTeam;
        }

        if ($equalTeams->count() == 2) {
            $secondTeam = $equalTeams->where('teamId', '!=', $firstTeam->teamId)->first();

            $game   = self::getGame($firstTeam, $secondTeam, $firstTeam->competitionID, $firstTeam->stage);

            if ($game !== null) {
                $looser = self::getLooser($game);
                if ($looser !== false) {
                    $looser = $teams->where('teamName', $looser)->first();
                    return $looser;
                }
            }
        }
    }

    public static function getGame($firstTeam, $secondTeam, $id, $stage)
    {
        $game = JuniorFixture::where(
            [
                ['hosts', $firstTeam->teamName],
                ['visitors', $secondTeam->teamName],
                ['competitionID', $id],
                ['stage', $stage],
            ]
        )->first();

        $game2 = JuniorFixture::where([
            ['hosts', $secondTeam->teamName],
            ['visitors', $firstTeam->teamName],
            ['competitionID', $id],
            ['stage', $stage],
        ])->first();

        if ($game == null) {
            return $game2;
        }

        return $game;
    }

    public static function getWinner($game)
    {
        if ($game->hosts_goals == $game->visitors_goals) {
            return false;
        }

        if ($game->hosts_goals > $game->visitors_goals) {
            return $game->hosts;
        }

        return $game->visitors;
    }

    public static function getLooser($game)
    {
        if ($game->hosts_goals == $game->visitors_goals) {
            return false;
        }

        if ($game->hosts_goals > $game->visitors_goals) {
            return $game->visitors;
        }

        return $game->hosts;
    }
}
