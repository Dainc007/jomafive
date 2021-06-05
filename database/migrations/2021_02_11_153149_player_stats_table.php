<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlayerStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('playerID');
            $table->string('teamName');
            $table->integer('teamID');
            $table->integer('gameID');
            $table->boolean('apperiance')->default(false);
            $table->boolean('goal')->nullable();
            $table->integer('assistantID')->nullable();
            $table->boolean('assist')->nullable();
            $table->integer('minute')->nullable();
            $table->integer('competitionID');
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
        Schema::dropIfExists('player_stats');
    }
}
