<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuniorFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junior_fixtures', function (Blueprint $table) {
            $table->id();
            $table->string('hosts');
            $table->string('visitors');
            $table->integer('hosts_goals');
            $table->integer('visitors_goals');
            $table->date('date');
            $table->time('hour');
            $table->integer('pitch');
            $table->integer('competitionID');
            $table->integer('stage')->nullable();
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
        Schema::dropIfExists('junior_fixtures');
    }
}
