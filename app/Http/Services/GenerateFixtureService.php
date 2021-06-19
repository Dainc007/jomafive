<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateFixtureService
{
    public function __construct(array $teams)
    {
        $totalTeams = 10;
        $maxTrials = 10_000_000;
        $start = time();

        $this->totalTeams = $totalTeams;
        $this->maxTrials  = $maxTrials;
        $this->start      = $start;
        $this->teams      = $teams;
        $this->fixtures = $this->generateFixtures($teams);
    }

    private function meetings(array $teams): array
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

    public static function generateSchedule($fixtures)
    {
        $request['startDate'] = '2021-01-01';
        $request['startTime'] = '20:00';
        $request['endTime']   = '22:00';
        $request['numOfPitches']   = 2;

        $startDate = $request['startDate'];
        $startDate = Carbon::createFromDate($startDate);

        $startTime = $request['startTime'];
        $startTime = Carbon::createFromTimeString($request['startTime']);

        $beginTime = $request['startTime'];
        $beginTime = Carbon::createFromTimeString($request['startTime']);

        $endTime = $request['endTime'];
        $endTime = Carbon::createFromTimeString($request['endTime']);

        $date = $startDate;
        $time = $startTime;

        $gameTime = 90;
        $pitch = 1;

        foreach ($fixtures as $round => $pair) {

            if ($request['numOfPitches'] >= $pitch) {
                $pair['pitch'] = $pitch;
                $pitch++;
            } else {
                $pitch = 1;
                $time->addMinutes($gameTime);
            }
            $pair['time']  =  $time;

            if ($request['endTime'] >= $time) {
                $pair['date']  =  $date;
            } else {
                $time = $startTime;
                $date->addDays(7);
            }
        }
    }

    private function generateFixtures(array $teams)
    {
        $trial = 0;
        $fixtures = [];

        do {
            if ($trial === $this->maxTrials) {
                exit('Nie udało się, za dużo prób :(');
            }

            $trial += 1;
            $meetings = $this->meetings($teams);
            $continue = count(array_count_values(array_map('count', $meetings))) !== 1;
        } while ($continue);

        $meetings = array_map(
            fn (array $round) => array_map(
                function ($match) {
                    shuffle($match);
                    return $match;
                },
                $round
            ),
            $meetings
        );

        foreach ($meetings as $round => $matches) {

            $matchday = [];

            foreach ($matches as $index => $teams) {
                [$teamA, $teamB] = $teams;

                $pair = [];
                $pair['host'] = $teamA;
                $pair['visitor'] = $teamB;

                $matchday[] = $pair;
            }

            $fixtures[] = $matchday;
        }

        print_r($fixtures);
        die;

        return $fixtures;
    }
}

$teams = ['Arsenal', 'Burnley', 'Chelsea', 'Dinamo Moskwa'];
$fixtures = new GenerateFixtureService($teams);
$schedule = GenerateFixtureService::generateSchedule($fixtures);

$params = [];
$params['date'] = today()->format('Y-m-d');
$params['hour'] = '20:30';
$params['competitionID'] = 20;
$params['stage'] = 1;

foreach ((new GenerateFixtureService($teams))->fixtures as $key => $matchday) {
    $params['round'] = $key + 1;
    foreach ($matchday as $team) {
        $params['hosts'] = $team['host'];
        $params['visitors'] = $team['visitor'];
    }

    print_r($params);
    /* DB::table('junior_fixtures')->insert($params); */
};
