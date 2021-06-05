<?php

namespace Database\Factories;

use App\Models\Admin\Team;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name(),
            'surname'     => $this->faker->lastName(),
            'yearOfBirth' => $this->faker->numberBetween(1980,2000),
            'teamName'    => Team::find(rand(1,10))->select('name'),
            'teamID'      => $this->faker->numberBetween(1,Team::count())
        ];
    }
}
