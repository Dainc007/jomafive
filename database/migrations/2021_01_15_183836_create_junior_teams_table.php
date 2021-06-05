<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuniorTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junior_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('class');
            $table->string('league')->default('kid');
            $table->enum('level', [1,2,3]);
            $table->string('shieldPath');
            $table->string('teamPhotoPath')->nullable();
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
        Schema::dropIfExists('junior_teams');
    }
}
