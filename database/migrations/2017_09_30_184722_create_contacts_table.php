<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique()->nullable();
            $table->string('type')->nullable();
            $table->boolean('spam')->default(false);
            $table->string('link')->nullable();

            $table->integer('colony_id')->unsigned();
            $table->foreign('colony_id')->references('id')->on('colonies');

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
        Schema::dropIfExists('contacts');
    }
}
