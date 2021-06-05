<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuniorPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junior_players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->integer('YearOfBirth')->numberBetween(1900, 2030)->nullable();
            $table->string('teamName');
            $table->integer('teamID');
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
        Schema::dropIfExists('junior_players');
    }
}
