<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($this->faker->numberBetween(3, 6)),
            'league' => $this->faker->randomElement(Article::getAvailableLeagues()),
            'content' => $this->faker->text($this->faker->numberBetween(250, 1000)),
            'photoPath' => 'images/gallery/'.$this->faker->numberBetween(1,10).'.png',
            'photoName' => $this->faker->numberBetween(1,10).'.png'
        ];
    }
}
