<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTestLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__test__levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_plan');
            $table->unsignedBigInteger('id_test_level');
            $table->dateTime('deleted')->nullable();
            $table->timestamps();

            $table->foreign('id_test_plan')->references('id')->on('test__plans');
            $table->foreign('id_test_level')->references('id')->on('test__levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order__test__levels');
    }
}
