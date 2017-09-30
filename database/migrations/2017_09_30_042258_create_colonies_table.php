<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColoniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colonies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('postal_code');

            $table->integer('municipality_id')->unsigned();
            $table->foreign('municipality_id')->references('id')->on('municipalities');

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
        Schema::dropIfExists('colonies');
    }
}
