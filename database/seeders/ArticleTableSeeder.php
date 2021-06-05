<?php

namespace Database\Seeders;

use App\Models\Article;
use Database\Factories\ArticleFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   //stworzonych zostało 80 wierszy. Laravel nie wykonał tej funkcji, a funkcję w database seeder
        
    }
}
