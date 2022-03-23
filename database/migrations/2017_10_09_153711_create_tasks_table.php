<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo',['llamada','cita','email'])->default('cita');
            $table->text('motivo');
            $table->text('lugar')->nullable();;
            $table->datetime('fecha');
            $table->integer('prioridad');
            $table->integer('schedule_id')->nullable();
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('tasks');
    }
}
