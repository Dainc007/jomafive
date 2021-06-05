<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->string('hosts');
            $table->integer('hostsID');
            $table->string('visitors');
            $table->integer('visitorsID');
            $table->integer('hosts_goals')->nullable();
            $table->integer('visitors_goals')->nullable();
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->integer('pitch')->nullable();
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
        Schema::dropIfExists('fixtures');
    }
}
