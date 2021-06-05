<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_tables', function (Blueprint $table) {
            $table->id();
            $table->string('teamName');
            $table->integer('teamId');
            $table->integer('points')->default(0);
            $table->integer('games')->default(0);
            $table->integer('wins')->default(0);
            $table->integer('draws')->default(0);
            $table->integer('losts')->default(0);
            $table->integer('goals_scored')->default(0);
            $table->integer('goals_lost')->default(0);
            $table->integer('bilans')->default(0);
            $table->integer('competitionID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_tables');
    }
}
