<?php

namespace App\Http\Services;

use Carbon\Carbon;

class GenerateFixtureService
{

    public static function generateMeetingsWithSchedule(array $teams, array $details): array
    {
        $schedule = [];
        $fixtures = self::generateMeetings($teams);

        $competitionId = $details['competitionId'];
        $date = Carbon::createFromDate($details['startDate']);
        $hour          = $details['firstGameHour'];
        $lastGameHour  = $details['lastGameHour'];
        $gameDuration  = $details['gameDuration'];
        $pitch = 1;
        $stage = 1;

        foreach ($fixtures as $round => $pair) {

            $round = [];
            foreach ($pair as $team) {

                $host    = $team[0];
                $visitor = $team[1];

                $game = [
                    'host'    => $host,
                    'visitor' => $visitor,
                    'date'    => $date,
                    'time'    => $hour,
                    'pitch'   => $pitch,
                    'stage'   => $stage,
                ];

                $round[] = $game;
            }
            $schedule[] = $round;
        }

        return $schedule;
    }

    private static function generateMeetings(array $teams): array
    {
        $pairs = [];

        // Generate all possible pairs with their unique binary flag of two positive bits
        foreach (array_slice($teams, 0, -1) as $teamIndex => $team) {
            foreach (array_slice($teams, $teamIndex + 1, null, true) as $opponentIndex => $opponent) {
                $pairs[] = [
                    'teams' => [$team, $opponent],
                    'flag' => (2 ** $teamIndex) | (2 ** $opponentIndex)
                ];
            }
        }

        shuffle($pairs);

        // Flatten the array to make binary flags the keys
        $pairs = array_combine(
            array_column($pairs, 'flag'),
            array_column($pairs, 'teams')
        );

        $result = array_fill(0, count($teams) - 1, []);

        // Stores the binary representation of each round to check if a pair fits the round (nobody plays twice)
        $map = [];

        foreach ($pairs as $pairFlag => $teams) {
            $matchingRound = null;

            foreach ($map as $round => &$roundFlag) {
                // Check if both teams haven't played in this round yet
                if (($roundFlag & $pairFlag) === 0) {
                    $roundFlag |= $pairFlag;
                    $matchingRound = $round;
                    break;
                }
            }

            if ($matchingRound === null) {
                $matchingRound = ($round ?? -1) + 1;
                $map[] = $pairFlag;
            }

            $result[$matchingRound][] = $teams;
        }

        return $result;
    }
}

$teams = [
    'Polska',
    'Brazylia',
    'Czechy',
    'Grecja',
    'Portugalia',
    'Hiszpania',
    'Francja',
    'Włochy',
    'Japonia',
    'Dania',
    'Szwecja',
    'Kolumbia',
];

$details = [
    'competitionId' => 10,
    'startDate'     => '2021-01-01',
    'firstGameHour' => '20:00',
    'lastGameHour'  => '22:00',
    'gameDuration'  => 40,

];

print_r(GenerateFixtureService::generateMeetingsWithSchedule($teams, $details));
