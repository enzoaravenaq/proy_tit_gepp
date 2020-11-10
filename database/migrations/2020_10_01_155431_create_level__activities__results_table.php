<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelActivitiesResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level__activities__results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_level');
            $table->string('actividad');
            $table->string('respuesta_sistema');
            $table->dateTime('deleted')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('level__activities__results');
    }
}
