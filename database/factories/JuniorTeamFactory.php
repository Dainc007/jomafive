<?php

namespace Database\Factories;

use App\Models\Admin\JuniorTeam;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class JuniorTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JuniorTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'class' => $this->faker->randomElement([2008,2009,2010,2011,2012]),
            'level' => $this->faker->numberBetween(1,3),
            'teamPhotoPath' => 'images/gallery/teamPhotos/everton.jpg',
            'shieldPath' => 'images/gallery/shields/'.$this->faker->numberBetween(3,56).'.png',
        ];
    }
}
