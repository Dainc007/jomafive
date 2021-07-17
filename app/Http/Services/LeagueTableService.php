<?php

namespace App\Http\Services;

use App\Models\Admin\JuniorLeagueTable;

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
}
