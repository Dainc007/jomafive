<?php

namespace App\Imports;

use App\Game;
use App\Models\JuniorFixture;
use Maatwebsite\Excel\Concerns\ToModel;

class JuniorFixtureImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JuniorFixture([
            'hosts' => $row[1],
            'visitors' => $row[2],
            'hosts_goals' => $row[3],
            'visitors_goals' => $row[4],
            'stage' => $row[5],
            'pitch' => $row[6],
            'date' => $row[7],
            'hour' => $row[8],
            'competitionID' => $row[9],
        ]);
    }
}
