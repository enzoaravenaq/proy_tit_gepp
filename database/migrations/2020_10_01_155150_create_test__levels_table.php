<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test__levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_plan');
            $table->unsignedBigInteger('id_level_req')->nullable();
            $table->unsignedInteger('ident_caso');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('actores');
            $table->string('ident_req')->nullable();
            $table->dateTime('deleted')->nullable();
            $table->timestamps();

            $table->foreign('id_test_plan')->references('id')->on('test__plans');
            $table->foreign('id_level_req')->references('id')->on('test__levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test__levels');
    }
}
