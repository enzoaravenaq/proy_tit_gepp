<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnlockedAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unlocked__achievements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_execution');
            $table->unsignedBigInteger('id_achievement');
            $table->dateTime('deleted')->nullable();
            $table->timestamps();


            $table->foreign('id_test_execution')->references('id')->on('test__executions');
            $table->foreign('id_achievement')->references('id')->on('achievements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unlocked__achievements');
    }
}
