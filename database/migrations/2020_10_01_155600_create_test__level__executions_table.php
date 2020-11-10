<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestLevelExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test__level__executions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_execution');
            $table->integer('puntaje_nivel')->default(0);
            $table->dateTime('deleted');
            $table->timestamps();


            $table->foreign('id_test_execution')->references('id')->on('test__executions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test__level__executions');
    }
}
