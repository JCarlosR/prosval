<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbox_messages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('reference_id');
            $table->string('type', 1); // R: response | C: confirmation

            $table->string('destination'); // phone

            // C
            $table->smallInteger('status')->nullable();
            // 0 Entregado
            // 1 No entregado
            // 2 Error
            // 3 Expirado
            // 4 Rechazado
            // 5 Desconocido
            // 6 No existe
            // 7 Formato incorrecto
            // 8 Pendiente
            $table->dateTime('confirmation_date')->nullable();

            // R
            $table->string('message')->nullable(); // sent to the client
            $table->string('response')->nullable(); // response of the client
            $table->dateTime('sent_date')->nullable();
            $table->dateTime('received_date')->nullable();

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
        Schema::dropIfExists('inbox_messages');
    }
}
