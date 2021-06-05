<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Article::factory(80)->create();
        \App\Models\Admin\Team::factory(30)->create();
        \App\Models\Admin\JuniorTeam::factory(30)->create();
        \App\Models\Admin\LeagueTable::factory(10)->create();
          
    }
}
