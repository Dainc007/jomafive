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
            $table->integer('hosts_goals')->nullable();
            $table->integer('visitors_goals')->nullable();
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->integer('pitch')->nullable();
            $table->integer('competitionID');
            $table->integer('stage');
            $table->integer('round');
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
