<?php

namespace App\Http\Services;

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
        $this->fixture    = $this->generateFixture($teams);
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

    public function generateFixture(array $teams)
    {
        $trial = 0;

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

        echo "```\n";
        printf('Liczba prób: %d%s', $trial, "\n");
        echo "\n";
        printf('Czas: %ds%s', time() - $this->start, "\n");
        echo "\n";
        foreach ($meetings as $round => $matches) {
            printf('Kolejka #%d%s', $round + 1, "\n\n");
            foreach ($matches as $index => $teams) {
                [$teamA, $teamB] = $teams;
                printf('%d. %s vs. %s%s', $index + 1, $teamA, $teamB, "\n");
            }
            echo "\n";
        }
        echo "```\n";
    }
}
