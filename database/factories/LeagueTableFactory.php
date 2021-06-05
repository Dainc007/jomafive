<?php

namespace Database\Factories;

use App\Models\Admin\Competition;
use App\Models\Admin\LeagueTable;
use App\Models\Admin\Team;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


class LeagueTableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LeagueTable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teamName' => $this->faker->company,
            'wins' => 0,
            'draws' => 0,
            'losts' => 0,
            'games' => 0,
            'points' => 0,
            'competitionID' => $this->faker->numberBetween(1,Competition::count()),
            'teamID' => $this->faker->unique()->randomElement(Team::select('id')->get())
        ];
    }
}
