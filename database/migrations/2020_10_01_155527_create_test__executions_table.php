<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test__executions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_plan');
            $table->string('nombre_ejecutor');
            $table->string('email');
            $table->integer('puntaje_final')->default(0);
            $table->string('titulo_jugador')->nullable();
            $table->dateTime('deteled')->nullable();
            $table->timestamps();


            $table->foreign('id_test_plan')->references('id')->on('test__plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test__executions');
    }
}
