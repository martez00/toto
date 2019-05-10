<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date_time');
            $table->integer('home_team')->unsigned();
            //$table->foreign('home_team')->references('id')->on('teams');
            $table->integer('home_team_score');
            $table->integer('away_team_score');
            $table->integer('away_team')->unsigned();
            //$table->foreign('away_team')->references('id')->on('teams');
            $table->tinyInteger('is_finished');
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
        Schema::dropIfExists('matches');
    }
}
