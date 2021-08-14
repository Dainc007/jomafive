<?php

namespace App\Observers;

use App\Http\Services\LeagueTableService;
use App\Models\Admin\JuniorLeagueTable;
use App\Models\JuniorFixture;

class JuniorFixtureObserver
{
    /**
     * Handle the JuniorFIxture "created" event.
     *
     * @param  \App\Models\JuniorFixture  $juniorFixture
     * @return void
     */
    public function created(JuniorFixture $juniorFixture)
    {
        //
    }

    /**
     * Handle the JuniorFIxture "updated" event.
     *
     * @param  \App\Models\JuniorFixture  $juniorFIxture
     * @return void
     */
    public function updated(JuniorFixture $juniorFixture)
    {
        $unplayedGame = JuniorFixture::where('competitionID', $juniorFixture->competitionID)
            ->where('stage', $juniorFixture->stage)
            ->where('hosts_goals', null)->first();

        if ($unplayedGame == null) {
            /* There is no unplayed games. We can make promotions and relegations */
            if ($juniorFixture->stage < 3) {
                for ($group = 1; $group < 4; $group++) {
                    $teams = JuniorLeagueTable::where('competitionID', $juniorFixture->competitionID)
                        ->where('stage', $juniorFixture->stage)
                        ->where('group', $group)
                        ->orderBy('points', 'DESC')->orderBy('bilans', 'DESC')->orderBy('goals_scored', 'DESC')
                        ->get();

                    $teamToPromote = LeagueTableService::teamToPromote($teams);
                    $teamToRelegate = LeagueTableService::teamToReleagate($teams);

                    if ($group == 1) {
                        if ($teamToRelegate !== null) {
                            JuniorLeagueTable::where('teamId', $teamToRelegate->teamId)
                                ->where('stage', $teamToRelegate->stage + 1)->where('group', $group)
                                ->update(['group' => $group + 1]);
                        }
                        continue;
                    }

                    if ($group == 2) {
                        if ($teamToRelegate !== null) {
                            JuniorLeagueTable::where('teamId', $teamToRelegate->teamId)
                                ->where('stage', $teamToRelegate->stage + 1)->where('group', $group)
                                ->update(['group' => $group + 1]);
                        }

                        if ($teamToPromote !== null) {
                            JuniorLeagueTable::where('teamId', $teamToPromote->teamId)
                                ->where('stage', $teamToRelegate->stage + 1)->where('group', $group)
                                ->update(['group' => $teamToPromote->group - 1]);
                        }
                        continue;
                    }

                    if ($group == 3) {
                        if ($teamToPromote !== null) {
                            JuniorLeagueTable::where('teamId', $teamToPromote->teamId)
                                ->where('stage', $teamToPromote->stage + 1)->where('group', $group)
                                ->update(['group' => $teamToPromote->group - 1]);
                        }
                        continue;
                    }
                }
            }
        }
    }

    /**
     * Handle the JuniorFIxture "deleted" event.
     *
     * @param  \App\Models\JuniorFIxture  $juniorFIxture
     * @return void
     */
    public function deleted(JuniorFIxture $juniorFIxture)
    {
        //
    }

    /**
     * Handle the JuniorFIxture "restored" event.
     *
     * @param  \App\Models\JuniorFIxture  $juniorFIxture
     * @return void
     */
    public function restored(JuniorFIxture $juniorFIxture)
    {
        //
    }

    /**
     * Handle the JuniorFIxture "force deleted" event.
     *
     * @param  \App\Models\JuniorFIxture  $juniorFIxture
     * @return void
     */
    public function forceDeleted(JuniorFIxture $juniorFIxture)
    {
        //
    }

    private function checkingPoints()
    {
    }
}
