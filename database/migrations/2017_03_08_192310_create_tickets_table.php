<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caso',60);               
            $table->enum('estado',['pendiente','resuelto','descartado','unassigned'])->default('pendiente');         
            $table->text('descripcion'); 
            $table->integer('prioridad');
            $table->integer('client_id')->unsigned()->nullable();;
//            $table->integer('product_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();;
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('product_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::drop('product_ticket');
        Schema::drop('tickets');
        
    }
}
