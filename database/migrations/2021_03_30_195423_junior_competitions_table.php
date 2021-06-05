<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JuniorCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junior_competitions', function (Blueprint $table) {
            $table->id();
            $table->enum('class', [2010, 2009] );
            $table->enum('level', [1,2,3]);
            $table->date('start')->default(today());
            $table->date('end')->nullable();
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
        //
    }
}
