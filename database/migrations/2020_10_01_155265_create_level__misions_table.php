<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelMisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level__misions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_test_level');
            $table->unsignedBigInteger('id_mision');
            $table->dateTime('deleted')->nullable();
            $table->timestamps();

            $table->foreign('id_test_level')->references('id')->on('test__levels');
            $table->foreign('id_mision')->references('id')->on('misions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level__misions');
    }
}
