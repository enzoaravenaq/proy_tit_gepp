<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files__executions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lvl_activity_exec')->nullable();
            $table->unsignedBigInteger('id_lvl_result_exec')->nullable();
            $table->string('ruta');
            $table->string('extension_archivo');
            $table->dateTime('deleted')->nullable();
            $table->timestamps();


            $table->foreign('id_lvl_activity_exec')->references('id')->on('level__activity__executions');
            $table->foreign('id_lvl_result_exec')->references('id')->on('level__results__executions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files__executions');
    }
}
